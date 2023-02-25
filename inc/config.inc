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

6. grid & colums  박스 배열 관련
https://getbootstrap.com/docs/5.3/layout/grid/
특히 Row columns (<div class="row row-col-3")이 유용하다. 

https://getbootstrap.com/docs/5.3/layout/columns/

*/

// 테스트 단계, CAFE24에 올릴 때는 false로 변경해야합니다.
$for_test = true;

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

// 로그인 확인
session_start();
if (isset($_SESSION['username']) && $_SESSION['username']) {
	$userlogin = true;
} else {
	$userlogin = false;
}

// 로그 파일
//if ($for_test)
//	$error_log_file = "../phperror".$homeip.".log";
//else
$error_log_file = "../phperror.log";

// 로그인 결과
$singinfail = "signinfail";
$passchangefail = "passchangefail";
$passchangediff = "passchangediff";
$passchangesuccess = "passchangesuccess";
$passchangefaillogin = "passchangefaillogin";

// 실적 기준 년
$thisYear = date("Y");
$thisMonth = date("m");
if ($thisMonth > 3) {
	$performance_from_year = $thisYear - 1;
	$performance_last_yesr = $thisYear;
} else {
	$performance_from_year = $thisYear - 2;
	$performance_last_yesr = $thisYear - 1;
}
$performance_yesrs = array($performance_from_year - 4, $performance_from_year - 3, $performance_from_year - 2, $performance_from_year - 1, $performance_from_year);

$config = array(
	'home_url' => "u1info.co.kr",
	'full_url' => "http://u1info.co.kr",
	'home_ip' => "183.111.199.212",
	'db_server' => "127.0.0.1",
	'db_user' => "guidecst",
	'db_password' => "dbstjdqh6551~",
	'db_name' => "guidecst",
	'company_kr_name' => "(주)유원건설정보",
	'company_kr_name_short' => "유원건설정보",
	'company_en_name' => "U1",
	'company_address' => "인천시 부평구 갈산동 94 C동 1807호 인천테크노벨리U1센터",
	'company_tel' => "032-209-1422",
	'company_hp' => "010-1234-1234",
	'company_license' => "678-86-02009",
	'company_fax' => "032-209-1423",
	'company_email' => "mp885@naver.com",  // 문의하기 이메일을 받을 담당자의 이메일 주소. utiles.inc에서 send_inquiry()에 사용
	'company_privacy_manager' => "현숙",
	'admin_email' => "admin@u1info.co.kr",  // cafe24에 발송 용으로 등록한 이메일 주소. utiles.inc에서 send_inquiry()에 사용
	'kakao_key' => "c089c8172def97eb00c07217cae17495", // 카카오에 등록하고 변경해주자
	'inquiry_classfication' => array('신규건설업등록', '양도양수', '기업진단' . '실태조사', '분할합병', '연말결산', '기타'), // 문의 구분
	'new_constructor_type_filter' => array('건축', '토목', '전문'), //신규면허 필터링
	'main_category' => array('종합건설업', '전문건설업', '기타공사업'),
	'종합건설업' => array("건축공사업", "토목공사업", "토목건축공사업", "산업·환경설비공사업", "조경공사업"),
	'전문건설업' => array( // 전문건설 필터링
		'지반조성·포장공사업' => array('토공사', '포장공사', '보링그라우팅파일공사'),
		'실내건축공사업' => array('실내건축'),
		'금속창호·지붕건축물조립공사업' => array('금속구조물·창호·온실공사', '지붕판금ㆍ건축물조립공사'),
		'도장·습식·방수·석공사업' => array('도장공사', '습식ㆍ방수공사', '석공사'),
		'조경식재·시설물공사업' => array('조경식재공사', '조경시설물설치공사'),
		'철근·콘크리트공사업' => array('철근ㆍ콘크리트공사'),
		'구조물해체·비계공사업' => array('구조물해체ㆍ비계공사'),
		'상·하수도설비공사업' => array('상하수도설비공사'),
		'철도·궤도공사업' => array('철도ㆍ궤도공사'),
		'철강구조물공사업' => array('철강구조물공사'),
		'수중·준설공사업' => array('수중공사', '준설공사'),
		'승강기·삭도공사업' => array('승강기설치공사', '삭도설치공사'),
		'기계가스설비공사업' => array('기계설비공사', '가스시설공사1종'),
		'가스난방공사업' => array('가스시설공사2종', '가스시설공사3종', '난방공사1종', '난방공사2종', '난방공사3종')
	),
	'기타공사업' => array("전기공사업", "정보통신공사업", "소방시설공사업", "주택건설사업자", "대지조성사업자", "부동산개발업"),
	//'기타공사업' => array("전기공사업", "정보통신공사업", "소방시설공사업", "주택건설사업자", "대지조성사업자", "부동산개발업", "안전진단전문기관", "나무병원", "석면해제제거업", "산림사업법인", "에너지절약전문기관", "지하수개발·이용시공", "엔지니어링사업자", "정비사업전문관리업", "개인하수처리시설", "승강기유지관리업", "문화재수리업"),
	'transfer_tag_array' => array("추천", "인기", "긴급"),
	'transfer_region_array' => array("수도권", "지방", "과밀", "비과밀"),
	'transfer_companytype_array' => array("주식회사", "유한회사", "합자회사", "합명회사", "비영리법인", "외국법인"),
	'max_sectors_per_company' => 7, //한 회사의 최대 업종 수
	'transfer_max_col' => 15, //한 페이지에 보여줄 갯수
	'transfer_max_pages' => 10, //보여질 pagination 갯수
	'page_files' => array(
		'회사소개' => "company.php",
		'신규건설업등록' => "license.php",
		'양도양수' => "transfer.php",
		'기업진단' => "diagnosis.php",
		'분할합병 및 법인전환' => "merger.php",
		'연말결산' => "settlement.php"
	),
	'page_other_files' => array(
		'양도양수정보' => "transfer_info.php",
		'양도양수수정' => "transfer_edit.php",
		'양도양수절차' => "transfer_proc.php",
		'신규건설업등록수정' => "license_edit.php"
	),
	'facebook_link' => '',
	'insta_link' => '',
	'twitter_link' => '',
	'blog_link' => 'https://blog.naver.com/mp885'
);



if ($for_test) {
	$config['db_server'] = $config['home_url'];
	$config['transfer_max_col'] = 10;
	$config['company_email'] = "fogyoon@monetcom.co.kr";
}

?>
<!-- 주요 설정 로드 됨 -->