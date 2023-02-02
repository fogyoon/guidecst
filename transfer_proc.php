<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "양도양수 절차";
$description = "건설업 양도양수 절차";
$keywords = "건설업, 양도양수, 양도양수 절차";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc"); // header에서 로그인 상태 확인합니다.
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img2 subhead-bright">
	<div class="container">
		<div class="page-haed">
		<h1 class="subhead-heading">양도양수 절차</h1>
		<p class="subhead-subheading">단계별 양도양수 절차를 확인하세요.</p>
		</div>
	</div>
</header>

<!-- Portfolio Section-->
<section class="page-section tranferproc pt-5" id="portfolio">
	<div class="container">
		<div class="clearfix mb-3">
			<button type="button" class="btn btn-warning float-end" onclick="location.href='<?=$config['page_files']['양도양수']?>'">양도양수 매물 확인</button>
		</div>

		<!-- 절차 -->
		<div class="row">
			<div class="col mb-4"><h4><i class="bi bi-calendar2-check"></i> 양도양수 절차</h4></div>
		</div>
		<div class="row row-cols-1 row-cols-md-3 justify-content-between g-4 mb-4 mb-md-4">
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">1 단계</h5>
						<p class="card-title">양도 등록</p>
						<div class="d-flex">
							<p>양도(매도)인이 <?=$config['company_kr_name_short']?>에 신청하거나 등록신청서를 다운로드 받아 작성 후 팩스 혹은 메일로 등록 신청 합니다</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">2 단계</h5>
						<p class="card-title">서류 검토</p>
						<div class="d-flex">
							<p>1차적으로 <?=$config['company_kr_name_short']?>에서 양도인의 제출서류를 면밀히 검토하여 양도 가능여부를 판단합니다.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">3 단계</h5>
						<p class="card-title">양도 대행계약</p>
						<div class="d-flex">
							<p>양도인과 <?=$config['company_kr_name_short']?> 간에 양도계약을 체결합니다.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-cols-1 row-cols-md-2 justify-content-between g-4 mb-4 mb-md-4">
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">4 단계</h5>
						<p class="card-title">양수 의뢰</p>
						<div class="d-flex">
							<p>수인이 <?=$config['company_kr_name_short']?>의 양수목록을 조회 후 양수 의뢰하거나 양수희망목록에 등록합니다. 이때 '담당컨설턴트'가 지정됩니다.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">5 단계</h5>
						<p class="card-title">실사</p>
						<div class="d-flex">
							<p><?=$config['company_kr_name_short']?> 실사팀에서는 양도대상회사의 모든 장부를 면밀히 실사합니다. 실사시 양수인이 지정한 회계팀도 함께 참여할 수 있습니다. 만약 양도가 불가능하다고 판단되면 양도양수계약을 파기하고 양수대행계약시 받은 수수료 중 실사시 실비를 제외하고 되돌려 줍니다.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-cols-1 row-cols-md-3 justify-content-between g-4 mb-4 mb-md-4">
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">6 단계</h5>
						<p class="card-title">양도양수 계약</p>
						<div class="d-flex">
							<p>양도인과 양수인간에 양도양수계약을 체결합니다. 이때 양수인은 양도양수계약금을 지급합니다.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">7 단계</h5>
						<p class="card-title">양수 대행계약</p>
						<div class="d-flex">
							<p>양수인과 <?=$config['company_kr_name_short']?> 간에 양수대행계약을 체결합니다.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">8 단계</h5>
						<p class="card-title">잔금지불</p>
						<div class="d-flex">
							<p>양수절차가 완료되면 양수인은 양도양수계약금 잔금과 양수수수료 잔금을 변경등기와 각서공증과 함께 지급합니다.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row row-cols-1 row-cols-md-2 justify-content-between g-4 mb-4 mb-md-4">
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">9 단계</h5>
						<p class="card-title">제반행정처리</p>
						<div class="d-flex">
							<p><?=$config['company_kr_name_short']?>팀에서는 건설업등록증 기재사항을 변경처리하여 드립니다.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col mb-2 mb-md-5">
				<div class="card h-100 card-proc">
					<div class="card-body">
						<h5 class="card-title-step">10 단계</h5>
						<p class="card-title">종료</p>
						<div class="d-flex">
							<p>양도 양수 제반 행정처리 완료 후 <?=$config['company_kr_name_short']?>의 사후 관리가 시작됩니다.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- 서류 -->
		<div class="row mt-3">
			<div class="col mb-4"><h4><i class="bi bi-file-earmark-text"></i> 양도양수 제출 서류</h4></div>
		</div>
		<div class="col mb-2 mb-md-5">
			<div class="card card-proc d-inline-flex">
				<div class="card-body">
					<p class="card-title">사본 각 1부씩 필요합니다.</p>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">법인 등기부 등본</li>
						<li class="list-group-item">사업자 등록증</li>
						<li class="list-group-item">건설업 등록증 / 등록수첩</li>
						<li class="list-group-item">3년의 재무제표증명원(회계사무소 발급 분)</li>
						<li class="list-group-item">경영상태확인서 (협회발행)</li>
						<li class="list-group-item">출자좌수 증명원 (공제조합)</li>
						<li class="list-group-item">융자금 잔액 확인원 (공제조합)</li>
						<li class="list-group-item">최근 5년간 실적 확인서</li>
						<li class="list-group-item">해당년도 공사 진행현황 (금액 및 기성별로 기재) - 자유양식</li>
					</ul>
				</div>
			</div>
		</div>
		</div>

	</div>
</section>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>