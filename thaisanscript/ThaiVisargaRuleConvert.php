<?php

namespace ThaiSanskrit;

use ThaiSanskrit\Util;

class ThaiVisargaConvert {

    private $util;

    function __construct() {
        $this->util = new Util();
    }

    public function convert($thaiChar) {
        $thaiChar = "    " . $thaiChar . "       "; // before space 4 after space 6  reserve  for condition
        $charList = $this->util->charList($thaiChar);

        foreach ($charList as $i => $char) {
//        for ($i = 0; $i < count($charList); $i++) {
            if ($char === "ะ") {

                $charList = $this->a_before_rule($charList, $i);
                $charList = $this->ah_rule($charList, $i);
                $charList = $this->ar_rule($charList, $i);
                $charList = $this->thaivisarga_rule($charList, $i);
            }
        }
//        return str_replace(" ", "", $this->util->convertListTostring($charList));
        return trim($this->util->convertListTostring($charList));
    }

    protected function a_before_rule($charList, $i) {
        // "ะนกะ" -> "อันกะ"; กรณี สระ ะ นำหน้าให้ใช้ อั
        $_before = $charList[$i - 1];
        $_current = $charList[$i];
        if ($_before == " " && $_current == "ะ") {

            $charList[$i] = "อั";
        }
        return $charList;
    }

    protected function ah_rule($charList, $i) {
        // brahma ยกเว้น namaḥ ตัด พรัหมะ เป็น พรหมะ เว้นไว้แต่ นะมะห์
        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];

        $condition = $_current == "ะ" &&
                $this->util->isThaiConsonant($_after1) &&
                $_after1 == "ห" &&
                !$this->util->isThaiVowel($_after2) &&
                $_after2 != ("์");

        if ($condition) {
            $charList[$i] = "";
        }
        return $charList;
    }

    protected function ar_rule($charList, $i) {
        // lokottaravāda sarva เปลี่ยน สะรวา เป็น ร หัน สรรวะ
        $_before = $charList[$i - 1];
        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];

        $condition = $_current == "ะ" &&
                $this->util->isThaiConsonant($_before) &&
                $_after1 == "ร" &&
                !$this->util->isThaiVowel($_after2);

        if ($condition) {
            $charList[$i] = "ร";
        }
        return $charList;
    }

    protected function thaivisarga_rule($charList, $i) {
        $_before4 = $charList[$i - 4];
        $_before3 = $charList[$i - 3];
        $_before2 = $charList[$i - 2];
        $_before1 = $charList[$i - 1];
        $_after1 = $charList[$i + 1];
        $conSarva = !($_before4 == "ส" && $_before3 == "ร" && $_before2 == "ร" && $_before1 == "ว" );

        if (($charList[$i + 1] != "ว" && $conSarva)) { //เว้น ว ไว้ทุก กรณี เช่น ตะว เพื่อป้องกันการ ออกเสียงสระ อัว เช่น ตัว
            $charList = $this->thaivisarga_non_consonantclusters($charList, $i);
            $charList = $this->thaivisarga_consonantclusters($charList, $i);
            $charList = $this->thaivisarga_lastword($charList, $i);
            $charList = $this->thaivisarga_non_sunskritvisarga($charList, $i);
        }
        return $charList;
    }

    protected function thaivisarga_non_consonantclusters($charList, $i) {
        //'ะกธ' !ร  เว้น แต่คำควบกล้ำ เช่น   พีชะครามะ CVCRVCV จะไม่เป็น พีชัครามะ
        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];

        $condition = ($_current === "ะ" &&
                $this->util->isThaiConsonant($_after1) &&
                $this->util->isThaiConsonant($_after2)) &&
                $_after2 != "ร";

        if ($condition) {
            $charList[$i] = "ั";
        }
        return $charList;
    }

    protected function thaivisarga_consonantclusters($charList, $i) {
//          
//        vajracchedikā วัชรัจเฉทิกา
//        วะชระจฉเทิกา
//        CACRVCCVC------ visarga
//        bījagrāma พีชะครามะ
//        --CACRVCV non visarga
//        sabrahmacāriṇaśca สะพรหมะ
//        CACRVHCV--------- non visarga
//        āryaprajñāpāramitāyai อารยะปรัชญาปาระมิตา(ประช)
//        --CAPRAJ non visarga
//        sarvajñāya สรรวะชญายะ
//        0000ACCV non visarga
//        nāvadhyānaprekṣiṇa นาวัธยานัเปรกษิณะ
//        --------CACRVCCV   non visarga
//        upaśrotrasthāne อุปัโศรตรัสถาเน
//        -CACRVCCV       non visarga
//           C A C R V C[C] visarga   1
//           C A C R V C[V] non visarga 2
//           C A C R V[H]C non visarga 3
//           C A[P R A J] non visarga 4
//           C A C R V C C V non visarga 5
//           0 1 2 3 4 5 6 7
        $_before4 = $charList[$i - 4];
        $_before3 = $charList[$i - 3];
        $_before2 = $charList[$i - 2];
        $_before1 = $charList[$i - 1];
        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];
        $_after3 = $charList[$i + 3];
        $_after4 = $charList[$i + 4];
        $_after5 = $charList[$i + 5];
        $_after6 = $charList[$i + 6];

        $condition = $this->util->isThaiConsonant($_before1) && //C
                $_current == "ะ" && //A
                $this->util->isThaiConsonant($_after1) && //C
                $_after2 == "ร" && //R       
                $this->util->isThaiVowel($_after3) && //V  
                $this->util->isThaiConsonant($_after4) && //C
                $_after4 != "ห" && //R
                $this->util->isThaiConsonant($_after5) && //C
                !($_after1 == "ป" && $_after2 == "ร" && $_after3 == "ะ" && $_after4 == "ช" ); //[P R A J]

//        $condition2 = $condition && $this->util->isThaiVowel($_after6);
        if ($condition) {
            $charList[$i] = "ั";
        }
//        if ($condition2) {
////            $charList[$i] = "ะ";
//        }
        return $charList;
    }

    protected function thaivisarga_lastword($charList, $i) {
        // ร'ะก  ' -> 'รัก  ' ตัวที่สุดท้าย

        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];

        $condition = $_current == "ะ" &&
                $this->util->isThaiConsonant($_after1) &&
                $_after1 != " " &&
                $_after2 == " ";

        if ($condition) {
            $charList[$i] = "ั";
        }
        return $charList;
    }

    protected function thaivisarga_non_sunskritvisarga($charList, $i) {
        // เว้นไว้ วิสรรค์ของสันสกฤต namaḥ  'นะมะห์'  trayaḥ  'ตระยะห์' ไม่ให้เป็น นะมัห
        $_current = $charList[$i];
        $_after1 = $charList[$i + 1];
        $_after2 = $charList[$i + 2];

        $condition = $_current == "ะ" &&
                $this->util->isThaiConsonant($_after1) &&
                !$this->util->isThaiCharacter($_after2) &&
                $_after2 != ("์");
        if ($condition) {
            $charList[$i] = "ั";
        }
        return $charList;
    }

}
