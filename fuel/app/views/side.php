<div id="side">
	<ul class="navi">
		<li class="nuv"><a href="/menu">TOP</a></li>
		<li class="nuv"><a href="/ttop">タスク管理システムTOP</a></li>
		<li>
			<ul class="subMenu">
				<li class="sub"><a href="/follow/create">フォロー報告</a></li>
				<li class="sub"><a href="/list">フォロー一覧</a></li>
				<?php //管理者のみ表示
					if($userlog_adflag != 0){?>
					<li class="sub"><a href="/user/create">ユーザー登録・更新</a></li>
					<li class="sub"><a href="/situation/create">状況フラグ登録・更新</a></li>
					<li class="sub"><a href="/appointment/create">対応方針登録・更新</a></li>
				<?php } ?>
			</ul>
		</li>
		<li class="nuv"><a href="/ktop">顧客管理システムTOP</a></li>
		<li>
			<ul  class="subMenu">
				<li class="sub"><a href="/clist">顧客一覧</a></li>
				<li class="sub"><a href="/case">要求一覧</a></li>
				<li class="sub"><a href="/mlist">対応一覧</a></li>
			</ul>
		</li>
	</ul>
</div>