<!doctype html>
<?php $this->load->view("templates/header"); ?>
<body>
       <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?= site_url('dashboard');?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a></li>
                    <li class="active"><a href="<?= site_url('peserta');?>"><i class="menu-icon fa fa-group"></i>Peserta</a></li>
                    <li><a href="<?= site_url('pembayaran');?>"><i class="menu-icon fa fa-money"></i>Pembayaran</a></li>
                    <li><a href="<?= site_url('soal');?>"><i class="menu-icon fa fa-puzzle-piece"></i>Soal</a></li>
                    <li><a href="<?= site_url('jawaban');?>"><i class="menu-icon fa fa-id-badge"></i>Jawaban Peserta</a></li>
                    <li><a href="<?= site_url('pengumuman');?>"><i class="menu-icon fa fa-bullhorn"></i>Pengumuman</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url(); ?>./assets/img/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="#"><img src="<?php echo base_url(); ?>./assets/img/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?php echo base_url(); ?>./assets/img/admin.jpg" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        
        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card"> 
                            <div class="card-header">
                                <strong class="card-title">Data Peserta</strong>    
                            </div>
                            <div class="card-body">
                                <button class="btn btn-success" onclick="add_peserta()"><i class="fa fa-plus"></i> Add</button>
                                <button class="btn btn-secondary" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
                                <br />
                                <br />
                                <table id="table" class="table table-basic dt-responsive nowrap" style="width:100% !important">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>No HP</th>
                                            <th>Photo</th>
                                            <th style="width:125px;">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>   
                        </div>  
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
        
    <?php 
        $this->load->view("templates/footer");
        $this->load->view("peserta/_script.php"); 
        $this->load->view("peserta/_form.php"); 
        
    ?>
    
</body>
</html>