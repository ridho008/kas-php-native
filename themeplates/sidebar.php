<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="img/<?= $_SESSION['admin']['foto']; ?>" class="user-image img-responsive"/>
					</li>
                    <li>
                        <a  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                      <li>
                        <a  href="?p=masuk"><i class="fa fa-desktop fa-2x"></i> Kas Masuk</a>
                    </li>
                    <li>
                        <a  href="?p=keluar"><i class="fa fa-qrcode fa-2x"></i> Kas Keluar</a>
                    </li>
						   <li  >
                        <a  href="?p=rekap"><i class="fa fa-bar-chart-o fa-2x"></i> Rekapitulasi Kas</a>
                    </li>	
                    <?php if($_SESSION['admin']['level'] ==='admin') : ?>
                      <li  >
                        <a  href="?p=users"><i class="fa fa-table fa-2x"></i> Management Users</a>
                    </li>	
                    <?php endif; ?>
                </ul>
               
            </div>
            
        </nav>