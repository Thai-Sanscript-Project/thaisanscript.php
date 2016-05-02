<?php

namespace ThaiSanskrit;

/**
 * Sanscript
 *
 * Sanscript is a Sanskrit transliteration library. Currently, it supports
 * other Indian languages only incidentally.
 *
 * Released under the MIT and GPL Licenses.
 * 
 *
 * @author Thanakrit.P
 *
 * k = ก (กะ)	kh = ข (ขะ)	g = ค (คะ)	gh = ฆ (ฆะ)	ṅ = ง (งะ) c = จ (จะ)	ch = ฉ
 * (ฉะ)	j = ช (ชะ)	jh = ฌ (ฌะ)	ñ = ญ (ญะ) ṭ = ฏ (ฏะ)	ṭh = ฐ (ฐะ)	ḍ = ฑ (ฑะ)	ḍh=
 * ฒ (ฒะ)	ṇ = ณ (ณะ) t = ต (ตะ)	th = ถ (ถะ)	d = ท (ทะ)	dh = ธ (ธะ)	n = น (นะ) p
 * p= ป (ปะ)	ph = ผ (ผะ)	b = พ (พะ)	bh = ภ (ภะ)	m = ม (มะ) y = ย (ยะ)	r = ร (ระ)
 * l = ล (ละ)	v = ว (วะ)	ś = ศ (ศะ) ṣ = ษ (ษะ)	s = ส (สะ)	h = ห (หะ)
 *
 * a = –ะ, –ั	ā = –า	i = –ิ	ī = –ี	u = –ุ ū = –ู	ṛ
 * (เมื่ออยู่ต้นคำหรือตามหลังพยัญชนะ) = ฤ e = เ–	ai = ไ–	o = โ–	o (ตามหลังสระ) =
 * ว	au = เ–า ṁ (ใช้แทนจันทรพินทุ) = ง	ṃ (ใช้แทนอนุสวาร) = ง	ḥ = ห์
 *
 */
class ThaiSanscript {

// Transliteration process option defaults.
    public $chandrabindu = "ँ";
    public $anusvara = "ํ";
    public $thaiVowelInFist = array(
        'ะ' => 'อะ',
        "า" => "อา",
        "ิ" => "อิ",
        "ี" => "อี",
        "ุ" => "อุ",
        "ู" => "อู",
        "เ" => "เอ",
        "โ" => "โอ",
        "ไ" => "ไอ"
    );
    public $singleVowel = array(
        "a" => "ะ",
        "ā" => "า",
        "i" => "ิ",
        "ī" => "ี",
        "u" => "ุ",
        "ū" => "ู",
        "ṛ" => "ฤ",
        "ṝ" => "ฤๅ",
        "ḷ" => "ฦ",
        "ḹ" => "ฦๅ",
        "e" => "เ",
        "ē" => "เ",
        "ō" => "โ",
        "o" => "โ",
    );
    public $mixVowel = array(
        "ai" => "ไ",
        "au" => "เา",
        "r̥" => "ฤ"
    );
    public $singleConsonant = array(
        "k" => "ก",
        "g" => "ค",
        "ṅ" => "ง",
        "c" => "จ",
        "j" => "ช",
        "ñ" => "ญ",
        "ṭ" => "ฏ",
        "ḍ" => "ฑ",
        "ṇ" => "ณ",
        "t" => "ต",
        "d" => "ท",
        "n" => "น",
        "p" => "ป",
        "b" => "พ",
        "m" => "ม",
        "y" => "ย",
        "r" => "ร",
        "l" => "ล",
        "v" => "ว",
        "ḻ" => "ฬ",
//        "ḷ" => "ฬ",
        "ś" => "ศ",
        "ṣ" => "ษ",
        "s" => "ส",
        "h" => "ห",
        "ṁ" => "ँ",
        "ṃ" => "ํ",
        "ḥ" => "ห์",
        "'" => "'"
    );
    public $mixConsonant = array(
        "kh" => "ข",
        "ch" => "ฉ",
        "ṭh" => "ฐ",
        "th" => "ถ",
        "ph" => "ผ",
        "n̄" => "ญ",
        "gh" => "ฆ",
        "jh" => "ฌ",
        "ḍh" => "ฒ",
        "dh" => "ธ",
        "bh" => "ภ"
    );
    public $num = array(
        "0" => "๐",
        "1" => "๑",
        "2" => "๒",
        "3" => "๓",
        "4" => "๔",
        "5" => "๕",
        "6" => "๖",
        "7" => "๗",
        "8" => "๘",
        "9" => "๙",
        "||" => "๚",
        "॥" => "๚",
        "|" => "ฯ",
        "।" => "ฯ",
    );
    public $mixVowelTh;
    public $mixVowelRm;
    public $singleVowelTh;
    public $singleVowelRm;
    public $mixConsonantTh;
    public $mixConsonantRm;
    public $singleConsonantTh;
    public $singleConsonantRm;
    public $numRm;
    public $numTh;
    public $revert_vowel;
    public $revert_consonant;
    public $anusvaraLast;

    public function __construct($inform = FALSE) {
        if ($inform) {
            $this->singleConsonant["ḥ"] = "ะ";
            $this->singleVowel["a"] = "a";
            $this->thaiVowelInFist = array_merge($this->thaiVowelInFist, array("a" => "อ"));
            unset($this->thaiVowelInFist['ะ']);
        }

        $this->revert_vowel = $this->setMappingIsThaiVowel();
        $this->revert_consonant = $this->setMappingIsThaiConsonant();
        $this->anusvaraLast = $this->setAnusvara();

        $return = $this->separate($this->mixVowel);
        $this->mixVowelTh = $return['th'];
        $this->mixVowelRm = $return['rm'];

        $return = $this->separate($this->singleVowel);
        $this->singleVowelTh = $return['th'];
        $this->singleVowelRm = $return['rm'];

        $return = $this->separate($this->mixConsonant);
        $this->mixConsonantTh = $return['th'];
        $this->mixConsonantRm = $return['rm'];

        $return = $this->separate($this->singleConsonant);
        $this->singleConsonantTh = $return['th'];
        $this->singleConsonantRm = $return['rm'];

        $return = $this->separate($this->num);
        $this->numTh = $return['th'];
        $this->numRm = $return['rm'];
    }

    private function separate($array) {
        $return = array();
        foreach ($array as $key => $value) {
            $return['rm'][] = $key;
            $return['th'][] = $value;
        }
        return $return;
    }

    public function mappingIsThaiVowel() {
        return $this->revert_vowel;
    }

    public function mappingIsThaiConsonant() {
        return $this->revert_consonant;
    }

    /* @var $revert array()
     * @var $revertMap array()
     */

    public function setRevertFlag($revert, $torevert) {

        foreach ($torevert as $key => $value) {
            $keyNew = $value;
            if (!isset($revert[$keyNew])) {
                $revert[$keyNew] = $key;
            }
        }
        return $revert;
    }

    public function getAnusvara($nextConsonant = "") {
        $return = "ม";
        //(เศษวรรค): y = ย (ยะ) r = ร (ระ) l = ล (ละ) v = ว (วะ) ś = ศ (ศะ)
        //ṣ = ษ (ษะ) s = ส (สะ) h = ห (หะ)
        // return ม
        $merge = $this->anusvaraLast;
        if (isset($merge[$nextConsonant])) {
            $return = $merge[$nextConsonant];
        }

        return $return;
    }

    private function setAnusvara() {

        //kaṇṭhya(Guttural)
        //ก (กะ): k = ก (กะ) kh = ข (ขะ) g = ค (คะ) gh = ฆ (ฆะ) ṅ = ง (งะ)
        $guttural_return = "ง";
        $guttural = array(
            "ก" => $guttural_return,
            "ข" => $guttural_return,
            "ค" => $guttural_return,
            "ฆ" => $guttural_return,
            "ง" => $guttural_return,
        );
        //tālavya(Palatal)
        //จ (จะ): c = จ (จะ) ch = ฉ (ฉะ) j = ช (ชะ) jh = ฌ (ฌะ) ñ = ญ (ญะ)
        $palatal_return = "ญ";
        $palatal = array(
            "จ" => $palatal_return,
            "ฉ" => $palatal_return,
            "ช" => $palatal_return,
            "ฌ" => $palatal_return,
            "ญ" => $palatal_return,
        );

        //mūrdhanya(Retroflex)
        //ฎ (ฎะ): ṭ = ฏ (ฏะ) ṭh = ฐ (ฐะ) ḍ = ฑ (ฑะ) ḍh = ฒ (ฒะ) ṇ = ณ (ณะ)
        $retroflex_return = "ณ";
        $retroflex = array(
            "ฏ" => $retroflex_return,
            "ฐ" => $retroflex_return,
            "ฑ" => $retroflex_return,
            "ฒ" => $retroflex_return,
            "ณ" => $retroflex_return,
        );
        //dantya(Dental)
        //ต (ตะ): t = ต (ตะ) th = ถ (ถะ) d = ท (ทะ) dh = ธ (ธะ) n = น (นะ)
        $dental_return = "น";
        $dental = array(
            "ต" => $dental_return,
            "ถ" => $dental_return,
            "ท" => $dental_return,
            "ธ" => $dental_return,
            "น" => $dental_return,
        );
        //oṣṭhya(Labial)
        //ป (ปะ): p = ป (ปะ) ph = ผ (ผะ) b = พ (พะ) bh = ภ (ภะ) m = ม (มะ)
        $labial_return = "ม";
        $labial = array(
            "ป" => $labial_return,
            "ผ" => $labial_return,
            "พ" => $labial_return,
            "ภ" => $labial_return,
            "ม" => $labial_return,
        );
        $merge = array_merge($guttural, $palatal, $retroflex, $dental, $labial);
        return $merge;
    }

    private function setMappingIsThaiVowel() {

        $revert = array();
        $revert["ั"] = 'a';
        $singleVowel = $this->singleVowel;
        $revert = $this->setRevertFlag($revert, $singleVowel);
        $mixVowel = $this->mixVowel;
        $revert = $this->setRevertFlag($revert, $mixVowel);
        return $revert;
    }

    private function setMappingIsThaiConsonant() {

        $revert = array();
        $revert["อ"] = 'a';
        $single = $this->singleConsonant;
        $revert = $this->setRevertFlag($revert, $single);
        $mix = $this->mixConsonant;
        $revert = $this->setRevertFlag($revert, $mix);
        return $revert;
    }

}
