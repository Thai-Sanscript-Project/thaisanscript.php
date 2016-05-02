<?php

use ThaiSanskrit\ThaiSanscriptAPI;

class spacialCase extends PHPUnit_Framework_TestCase {


    public function __construct() {

    }


    public function testCase1() {
        $this->spacialCase("prātimōkṣasūtram", "ปราติโมกษะสูตรัม");
    }

    public function testCase2() {
        $this->spacialCase("uddānam", "อุททานัม");
    }

    public function testCase3() {
        $this->spacialCase("-uddānam", "-อุททานัม");
    }

    public function testCase4() {
        $this->spacialCase("uddānam-uddānam", "อุททานัม-อุททานัม");
    }

    public function testCase5() {
        $this->spacialCase("na-an", "นะ-อัน");
    }

    public function testCase6() {
        $this->spacialCase("naan", "นะอัน");
    }

    public function testCase7() {
        $this->spacialCase("bījagrāmabhūtagrāma", "พีชะครามะภูตะครามะ");
    }

    public function testCase8() {
        $this->spacialCase("namaḥ", "นะมะห์");
    }

    public function testCase9() {
        $this->spacialCase("trayaḥ", "ตระยะห์");
    }

    public function testCase10() {
        $this->spacialCase("daurvvalyamanāviṣkṛtvā", "เทารววัลยะมะนาวิษกฤตวา");
    }

    public function testCase11() {
        $this->spacialCase("maitreya", "ไมเตรยะ");
    }

    public function testCase12() {
        $this->spacialCase("vajracchedikā ", "วัชรัจเฉทิกา");
    }

    public function testCase13() {
        $this->spacialCase("sarva ", "สรรวะ");
        $this->spacialCase("dharma ", "ธรรมะ");
        $this->spacialCase("punar ", "ปุนรร");
    }

    public function testCase14() {
        $this->spacialCase("parivarjjayitvā ", "ปะริวรรชชะยิตวา");
    }

    public function testCase15() {
        $this->spacialCase("lokottaravāda ", "โลโกตตะระวาทะ");
    }

    public function testCase16() {
        $this->spacialCase("brahma ", "พรหมะ");
    }

    public function testCase17() {
        $this->spacialCase("sabrahmacāriṇaśca ", "สะพรหมะจาริณัศจะ");
    }

    public function testCase18() {
        $this->spacialCase("sarvvatra ", "สรรววะตระ");
    }

    public function testCase20() {
        $this->spacialCase("otīṇṇā ", "โอตีณณา");
    }

//saṃkara
//saṃcara
//saṃṭhāna
//saṃdhāna
//saṃbhāra
//saṃkhāra
//saṃjāti
//saṃṭhiti
//saṃnipāta
//saṃbandha
//saṃyog
//saṃvāsa
//saṃsāra
//saṃvara
//saṃharaṇa
    public function testCaseAnusavara() {
        $this->spacialCase("saṃkara", "สังกะระ");
        $this->spacialCase("saṃcara", "สัญจะระ");
        $this->spacialCase("saṃṭhāna", "สัณฐานะ");
        $this->spacialCase("saṃdhāna", "สันธานะ");
        $this->spacialCase("saṃbhāra", "สัมภาระ");
        $this->spacialCase("saṃkhāra", "สังขาระ");
        $this->spacialCase("saṃjāti", "สัญชาติ");
        $this->spacialCase("saṃṭhiti", "สัณฐิติ");
        $this->spacialCase("saṃnipāta", "สันนิปาตะ");
        $this->spacialCase("saṃbandha", "สัมพันธะ");
        $this->spacialCase("saṃyog", "สัมโยค");
        $this->spacialCase("saṃvāsa", "สัมวาสะ");
        $this->spacialCase("saṃsāra", "สัมสาระ");
        $this->spacialCase("saṃvara", "สัมวะระ");
        $this->spacialCase("saṃharaṇa", "สัมหะระณะ");
    }

    public function testCaseVyVisaga() {
        //
        $this->spacialCase("vyākaraṇa", "วยากะระณะ");
        $this->spacialCase("sthātavyaṃ", "สถาตะวยัม"); // สถาตัวยัม
        $this->spacialCase("pratipattavyaṃ", "ประติปัตตะวยัม"); // ประติปัตตัวยัม
        $this->spacialCase("pragrahītavyam", "ประคระหีตะวยัม"); // ประคระหีตัวยัม
    }

    public function testCase21() {

        $this->spacialCase("srotaāpannasyaivaṃ", "โสรตะอาปันนัสไยวัม"); //โสรตะาปันนัสไยวัม
    }

    public function testCase22() {

        $this->spacialCase("srotaāpattiphalaṃ", "โสรตะอาปัตติผะลัม"); // โสรตะาปัตติผะลัม
    }

    public function testCase23() {

        $this->spacialCase("jāni‍a", "ชานิอะ"); // ชานิอะ
    }

    public function testCase24() {

        $this->spacialCase("srotaapattiphalaṃ", "โสรตะอะปัตติผะลัม"); // โสรตะาปัตติผะลัม
    }

    public function testCase25() {

        $this->spacialCase("-āryavajracchedikā", "-อารยะวัชรัจเฉทิกา"); // ॥ารยะวัชรัจเฉทิกา     
    }

    public function testCase26() {

        $this->spacialCase("draupadī", "เทราปะที"); //โสรตะาปันนัสไยวัม        
    }

    public function testCase27() {

        $this->spacialCase("draupadī", "เทราปะที"); //โสรตะาปันนัสไยวัม        
    }

    public function testCase28() {

        $this->spacialCase("āryaprajñāpāramitāyai", "อารยะปรัชญาปาระมิตาไย"); //อารยัปรัชญาปาระมิตาไย        
    }

//sarvairekajātipratibaddhaiḥ สรรไเวรกะชาติประติพัทไธห์
    public function testCaseTest29() {
        //echo ord('');echo ord('') ;
        $this->spacialCase("sarvairekajātipratibaddhaiḥ", "สรรไวเรกะชาติประติพัทไธห์"); //อารยัปรัชญาปาระมิตาไย  
    }

    public function testCaseTest30() {
        //echo ord('');echo ord('') ;
        $this->spacialCase("bhagavānāha-evaṃ", "ภะคะวานาหะ-เอวัม"); //ภะคะวานาหะเ-วัม   
    }

//    public function testCaseTest31() {
//        $this->spacialCase("dharmakṣetre", "ธรรมะเกษเตร"); //ภะคะวานาหะเ-วัม   
//    }
//
//    public function testCaseTest32() {
//        //echo ord('');echo ord('') ;
//        $this->spacialCase("bhagavānāha-ovaṃ", "ภะคะวานาหะ-เอวัม"); //ภะคะวานาหะเ-วัม   
//    }
    public function testCaseTest33() {
        //echo ord('');echo ord('') ;
        $this->spacialCase("-avaṃ-āvaṃ-ivaṃ-īvaṃ-uvaṃ-ūvaṃ-ṛvaṃ-evaṃ-ēvaṃ-ōvaṃ-ovaṃ-aivaṃ-auvaṃ-r̥vaṃ", "-อะวัม-อาวัม-อิวัม-อีวัม-อุวัม-อูวัม-ฤวัม-เอวัม-เอวัม-โอวัม-โอวัม-ไอวัม-เอาวัม-ฤวัม"); //ภะคะวานาหะเ-วัม   
    }

    public function testCaseTest34() {
        //echo ord('');echo ord('') ;
//        ASRT :ภะคะวานาหะ-เอวัม ' : '-อะวัม-อาวัม-อิวัม-อีวัม-อุวัม-อูวัม-ฤวัมเ-วัมเ-วัมโ-อวัมโ-อวัมไ-วัมเ-อาวัม-ฤวัม']:ภะคะวานาหะ-เอวัม ' : '-อะวัม-อาวัม-อิวัม-อีวัม-อุวัม-อูวัม-ฤวัม-เวัม-เวัม-โอวัม-โอวัม-ไอวัม-เอาวัม-ฤวัม']
        //$this->spacialCase(" avama āvama ivama īvama uvama ūvama ṛvama evama ēvama ōvama ovama aivama auvama r̥vama", "อะวะมะอาวะมะอิวะมะอีวะมะอุวะมะอูวะมะฤวะมะเอวะมะเอวะมะโอวะมะโอวะมะไอวะมะเอาวะมะฤวะมะ"); //ภะคะวานาหะเ-วัม   
        $this->spacialCase(" avama āvama ivama īvama uvama ūvama ṛvama evama ēvama ōvama ovama aivama auvama r̥vama", "อะวะมะ อาวะมะ อิวะมะ อีวะมะ อุวะมะ อูวะมะ ฤวะมะ เอวะมะ เอวะมะ โอวะมะ โอวะมะ ไอวะมะ เอาวะมะ ฤวะมะ"); //ภะคะวานาหะเ-วัม   
    }

    public function testCase35() {
        $this->spacialCase("nāvadhyānaprekṣiṇa", "นาวัธยานะเปรกษิณะ"); //นาวัธยานัเปรกษิณะ        
    }

    public function testCase36() {
        $this->spacialCase("upaśrotrasthāne", "อุปะโศรตรัสถาเน"); //นาวัธยานัเปรกษิณะ        
    }

    public function testCase37() {
        $this->spacialCase("kuladuhitṝṇāṃ", "กุละทุหิตฤๅณาม"); //กุละทุหิตṝณาม        
    }

    public function testCase38() {
        $this->spacialCase("kuladuhitḷṇāṃ", "กุละทุหิตฦณาม"); //กุละทุหิตṝณาม        
    }

    public function testCase39() {
        $this->spacialCase("kuladuhitḹṇāṃ", "กุละทุหิตฦๅณาม"); //กุละทุหิตṝณาม        
    }

    //apabhraṃśa อะปัภรัมศะ อปภฺรํศ อะปะภรัมศะ
    public function testCase40() {
        $this->spacialCase("lokāḥ samastāḥ sukhinobhavantu", "โลกาห์ สะมัสตาห์ สุขิโนภะวันตุ"); //กุละทุหิตṝณาม        
    }

    public function spacialCase($src, $asrt) {
        $thaiSanscriptAPI = new ThaiSanscriptAPI();
        $src = $thaiSanscriptAPI->transliterationTracking($src);
        echo " ['ASRT :" . $asrt . "' : '" . $src . "'] \n";
        $this->assertEquals($asrt, $src);
    }

}
