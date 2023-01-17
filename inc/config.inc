<?php

/*
Bootsrap 찾아보기

1. col 취치 설정
https://getbootstrap.com/docs/5.3/utilities/flex/

2. 아이템 겹치기 z-index
https://getbootstrap.com/docs/5.3/utilities/z-index/

3. 백그라운드
https://getbootstrap.com/docs/5.3/utilities/background/

4. 경계 border
https://getbootstrap.com/docs/5.3/utilities/borders/

5. Sizing
https://getbootstrap.com/docs/5.3/utilities/sizing/

*/

// 주요 설정 들

$homeip = getenv('HTTP_CLIENT_IP') ?:
	getenv('HTTP_X_FORWARDED_FOR') ?:
	getenv('HTTP_X_FORWARDED') ?:
	getenv('HTTP_FORWARDED_FOR') ?:
	getenv('HTTP_FORWARDED') ?:
	getenv('REMOTE_ADDR');
$homeip = trim($homeip);

$thispage_filename = str_replace("/", "", $_SERVER['SCRIPT_NAME']);
$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

// 테스트 단계
$for_test = true;

// 실적 기준 년
$thisYear = date("Y");
$thisMonth = date("m");
if ($thisMonth > 3) {
	$performance_from_year = $thisYear -1;
} else {
	$performance_from_year = $thisYear -2;
}


$config = array(
	'home_url' => "guideconsulting.co.kr",
	'home_ip' => "183.111.199.212",
	'db_user' => "guidecst",
	'db_password' => "dbstjdqh6551~",
	'db_name' => "guidecst",
	'company_kr_name' => "주식회사 가이드",
	'company_en_name' => "Guide Consulting",
	'company_address' => "강원도 원주시 판부면 내동막길 51-40",
	'company_tel' => "032-209-1422",
	'company_hp' => "010-1234-1234",
	'company_license' => "678-86-02009",
	'company_fax' => "032-209-1423",
	'company_email' => "email@email.com",
	'company_privacy_manager' => "현숙",
	'inquiry_classfication' => array('면허등록', '양도양수', '기업진단'. '실태조사', '잔고증명', '기타'), // 문의 구분
	'constructor_type_filter' => array('조경', '토목', '건축', '토목건축', '산업환경설비'), //종합건설 필터링
	'new_constructor_type_filter' => array('건축', '토목', '전문'), //신규면허 필터링
	'pro_constructor_type_filter' => array( // 전문건설 필터링
		'지반조성·포장공사업' => array('토공', '포장', '보링'),
		'실내건축공사업' => array('실내'),
		'금속창호·지붕건축물조립공사업' => array('금속', '지붕'),
		'도장·습식·방수·석공사업' => array('도장', '습식', '석공'),
		'조경식재·시설물공사업' => array('조경식재', '조경시설물'),
		'철근·콘크리트공사업' => array('철근'),
		'구조물해체·비계공사업' => array('비계'),
		'상·하수도설비공사업' => array('상하'),
		'철도·궤도공사업' => array('철도'),
		'철강구조물공사업' => array('철강구조물'),
		'수중·준설공사업' => array('수중', '준설'),
		'승강기·삭도공사업' => array('승강기', '식도'),
		'기계가스설비공사' => array('기계설비', '가스1종'),
		'시설물' => array('시설물')
	),
	'transfer_tag_array' => array("추천", "인기", "긴급"),
	'transfer_max_col' => 2,
	'page_files' => array(
		'회사소개' => "company.php",
		'면허등록기준' => "license.php",
		'양도양수' => "transfer.php",
		'기업진단' => "diagnosis.php",
		'건설관련정보' => "relatedinfo.php",
		'연말결산/잔고증명' => "settlement.php"
	)
);
?>
<!-- 주요 설정 로드 됨 -->