<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "회사소개";
$description = "건설업 회사소개";
$keywords = "건설업, 회사소개";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img">
	<div class="container">
		<h1 class="subhead-heading">회사소개</h1>
		<p class="subhead-subheading">회사소개 페이지입니다.</p>
	</div>
</header>





<br>
<br>




        
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">건설업의 앞선 컨설팅</h2>
                            <p class="text-L">가이드컨설팅은 빠르게 변화하는 건설업에서 다년간의 경험과 축적된 노하우을 가지고 각각의 기업상황에 맞는 정보를 제공하고있습니다.
양도양수, 기업진단, 면허등록기준, 경영운영의 전반에 걸친 정확하고 믿을수 있는 맞춤형정보로 앞선 컨설팅을 해드립니다. <br><br>가이드컨설팅 임직원일동</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">건설업의 앞선 컨설팅</h2>
							<p class="text-L">가이드컨설팅은 빠르게 변화하는 건설업에서 다년간의 경험과 축적된 노하
기준, 경영운영의 전반에 걸친 정확하고 믿을수 있는 맞춤형정보로 앞선 컨설팅을 해드립니다.                        
						</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">건설업의 앞선 컨설팅</h2>
							<p class="text-L">가이드컨설팅은 빠르게 변화하는 건설업에서 다년간의 경험과 축적된 노하
기준, 경영운영의 전반에 걸친 정확하고 믿을수 있는 맞춤형정보로 앞선 컨설팅을 해드립니다.                        
						</div>
                    </div>
                </div>
            </div>
        </section>





<br>






<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>