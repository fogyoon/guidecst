<?php
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

$config = array(
	'home_url' => "guideconsulting.co.kr",
	'home_ip' => "183.111.199.212",
	'db_user' => "guidecst",
	'db_password' => "dbstjdqh6551~",
	'company_kr_name' => "가이드컨설팅",
	'company_en_name' => "Guide Consulting",
	'company_address' => "서울 어디구 어디가 12223-45 5층 501호",
	'company_tel' => "02-1234-1234",
	'company_hp' => "010-1234-1234",
	'company_license' => "000-00-00000",
	'company_fax' => "02-4321-4321",
	'company_fax' => "email@email.com",
	'company_privacy_manager' => "홍길동",
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
	)
);
?>
<!-- 주요 설정 로드 됨 -->