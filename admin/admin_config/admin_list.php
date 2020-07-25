<?php
$PATH_SELF = explode("/",$_SERVER["PHP_SELF"]);
$MODULE = $PATH_SELF[sizeof($PATH_SELF)-2];
$MODULE_FILE = $PATH_SELF[sizeof($PATH_SELF)-1];
?>
<div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-list">
          <ul class="tpl-left-nav-menu">
            <li class="tpl-left-nav-item">
              <a href="../admin_index/"  class="nav-link <?php echo $MODULE=='admin_index'?'active':''?>">
                <i class="am-icon-home"></i>
                <span>首页</span></a>
            </li>
			<li class="tpl-left-nav-item">
				<a href="javascript:;" class="nav-link tpl-left-nav-link-list  <?php echo $MODULE=='admin_Basicsetup'?'active':''?>">
					 <i class="am-icon-cogs"></i>
					<span>系统设置</span>
					<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right <?php echo $MODULE=='admin_Basicsetup'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
				</a>
				 <ul class="tpl-left-nav-sub-menu  <?php echo $MODULE=='admin_Basicsetup'?'active':''?>">

					<li>
						<a href="../admin_Basicsetup/Basicsetup.php" class="<?php echo $MODULE_FILE=='Basicsetup.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>基本设置</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
                     <li>
                         <a href="../admin_Basicsetup/Advanced.php" class="<?php echo $MODULE_FILE=='Advanced.php'?'active':''?>">
                             <i class="am-icon-angle-right"></i>
                             <span>高级设置</span>
                             <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                         </a>
                     </li>
					<li>
						<a href="../admin_Basicsetup/statistics.php"  class="<?php echo $MODULE_FILE=='statistics.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>流量统计设置</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>				
				</ul>
            </li>
              <li class="tpl-left-nav-item">
                  <a href="javascript:;" class="nav-link tpl-left-nav-link-list  <?php echo $MODULE=='admin_user'?'active':''?>">
                      <i class="am-icon-users"></i>
                      <span>用户设置</span>
                      <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right <?php echo $MODULE=='admin_user'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
                  </a>
                  <ul class="tpl-left-nav-sub-menu  <?php echo $MODULE=='admin_user'?'active':''?>">

                      <li>
                          <a href="../admin_user/userlist.php" class="<?php echo $MODULE_FILE=='userlist.php'?'active':''?>">
                              <i class="am-icon-angle-right"></i>
                              <span>用户列表</span>
                              <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                          </a>
                      </li>
                      <li>
                          <a href="../admin_user/order.php" class="<?php echo $MODULE_FILE=='order.php'?'active':''?>">
                              <i class="am-icon-angle-right"></i>
                              <span>充值订单</span>
                              <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                          </a>
                      </li>
                      <li>
                          <a href="../admin_user/cardkey.php" class="<?php echo $MODULE_FILE=='cardkey.php'?'active':''?>">
                              <i class="am-icon-angle-right"></i>
                              <span>卡密管理</span>
                              <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="tpl-left-nav-item">
				<a href="javascript:;" class="nav-link tpl-left-nav-link-list  <?php echo $MODULE=='admin_ad'?'active':''?>">
					<i class="am-icon-sitemap"></i>
					<span>广告设置</span>
					<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right  <?php echo $MODULE=='admin_ad'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
				</a>
				 <ul class="tpl-left-nav-sub-menu  <?php echo $MODULE=='admin_ad'?'active':''?>">

					<li>
						<a href="../admin_ad/ad_top.php"  class="<?php echo $MODULE_FILE=='ad_top.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>头部横幅广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_ad/ad_video.php"  class="<?php echo $MODULE_FILE=='ad_video.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>播放横幅广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_ad/ad_Couplets.php"  class="<?php echo $MODULE_FILE=='ad_Couplets.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>对联展现广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_ad/ad_float.php"  class="<?php echo $MODULE_FILE=='ad_float.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>底部浮漂广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_ad/ad_js.php"  class="<?php echo $MODULE_FILE=='ad_js.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>广告联盟JS广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_ad/ad_Popup.php"  class="<?php echo $MODULE_FILE=='ad_Popup.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>每日弹窗广告</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>					
				</ul>
            </li>			

			<li class="tpl-left-nav-item">
				<a href="javascript:;" class="nav-link tpl-left-nav-link-list <?php echo $MODULE=='admin_security'?'active':''?>">
					 <i class="am-icon-expeditedssl"></i>
					<span>安全管理</span>
					<i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right  <?php echo $MODULE=='admin_security'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
				</a>
				 <ul class="tpl-left-nav-sub-menu <?php echo $MODULE=='admin_security'?'active':''?>">

					<li>
						<a href="../admin_security/security_Journal.php" class="<?php echo $MODULE_FILE=='security_Journal.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>登录日志</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_security/security_userpass.php" class="<?php echo $MODULE_FILE=='security_userpass.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>登录重置</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>
					<li>
						<a href="../admin_security/security_301.php" class="<?php echo $MODULE_FILE=='security_301.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>301重定向</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>						
				</ul>
            </li>

 
			
				<li class="tpl-left-nav-item">
				<a href="javascript:;" class="nav-link tpl-left-nav-link-list  <?php echo $MODULE=='admin_qita'?'active':''?>">
					<i class="am-icon-google"></i>
					<span>其它设置</span>
					 <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right  <?php echo $MODULE=='admin_qita'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
				</a>
				 <ul class="tpl-left-nav-sub-menu  <?php echo $MODULE=='admin_qita'?'active':''?>">
                     <li>
                         <a href="../admin_qita/SiteGroup_list.php" class="<?php echo $MODULE_FILE=='SiteGroup_list.php'?'active':''?>">
                             <i class="am-icon-angle-right"></i>
                             <span>站群管理</span>
                             <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                         </a>
                     </li>
					<li>
						<a href="../admin_qita/qita_dizhi.php" class="<?php echo $MODULE_FILE=='qita_dizhi.php'?'active':''?>">
							<i class="am-icon-angle-right"></i>
							<span>地址公告设置</span>
							<i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
						</a>
					</li>						
				</ul>
            </li>		
			
			


            <li class="tpl-left-nav-item">
              <a href="javascript:;" class="nav-link tpl-left-nav-link-list <?php echo $MODULE=='Plug'?'active':''?>">
                <i class="am-icon-plus-square"></i>
                <span>扩展管理</span>
                  <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right  <?php echo $MODULE=='Plug'?'':'tpl-left-nav-more-ico-rotate'?>"></i>
              </a>
                <ul class="tpl-left-nav-sub-menu  <?php echo $MODULE=='Plug'?'active':''?>">
                    <li>
                        <a href="../Plug/myplug.php" class="<?php echo $MODULE_FILE=='myplug.php'?'active':''?>">
                            <i class="am-icon-angle-right"></i>
                            <span>我的扩展</span>
                            <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                        </a>
                    </li>
                    <li>
                        <a href="../Plug/appstore.php" class="<?php echo $MODULE_FILE=='appstore.php'?'active':''?>">
                            <i class="am-icon-angle-right"></i>
                            <span>应用商店</span>
                            <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                        </a>
                    </li>
                </ul>
            </li>


              <li class="tpl-left-nav-item">
                  <a href="../admin_connection/connection.php" class="nav-link tpl-left-nav-link-list <?php echo $MODULE=='admin_connection'?'active':''?>" >
                      <i class="am-icon-gg"></i>
                      <span>友链管理</span>
                      <i class="tpl-left-nav-content tpl-badge-danger">友链</i></a>
              </li>
          </ul>
        </div>
      </div>
