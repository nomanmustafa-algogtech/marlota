 <? $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array(); ?>
 <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Referrals</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li>Referrals</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                        <ul class="nav nav-tabs mb-6" role="tablist">
                            <li class="link-item">
                                <a href="<?=base_url();?>user/account">Dashboard</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/orders">Orders</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/referrals" class="active">Referrals</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/logout">Logout</a>
                            </li>
                        </ul>

                        <div class="tab-content mb-6">
                           
                            <div class="tab-pane active in" id="account-orders">
                                <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title text-capitalize ls-normal mb-0">Referrals</h4>
                                    </div>
                                </div>

                                <table class="shop-table account-orders-table mb-6">
                                    <thead>
                                        <tr>
                                            <th class="" style="text-align: left;">#</th>
                                            <th style="text-align: left;">Signup Date</th>
                                            <th style="text-align: left;">Account</th>
                                            <th style="text-align: left;">Level</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                            <?php
                                            $sn=0;
                                            $app_referrals = $this->db->query("SELECT * FROM app_referrals WHERE user_id = '{$userData['id']}'")->result_array();
                                            foreach($app_referrals as $row){
                                                $ruser = $this->db->query("SELECT * FROM app_users where id = '{$row['referral_id']}'")->row_array();
                                            $sn++; ?>
                                                <tr>
                                                    <td><?=$sn;?></td>
                                                    <td><?=date('d/m/Y', strtotime($row['created_date']));?></td>
                                                    <td><?=$ruser['full_name'];?><br><?=$ruser['phone'];?></td>
                                                    <td>Level <?=$row['level'];?></td>
                                                </tr>
                                            <?php } ?>
                                        
                                        
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>