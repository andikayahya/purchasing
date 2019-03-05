<?php
    $qrecord = "SELECT * FROM `t_product` WHERE id = '1'";
    $rrecord = mysqli_query($konek, $qrecord);
    $rwrecord = mysqli_fetch_array($rrecord);
    {
?> 

 <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2><?php echo $rwrecord['product_title'];?></h2>
                            <p><?php echo $rwrecord['data_product'];?></p>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Supplier</th>
                                        <th>Visit Date</th>
                                    </tr>
                                </thead>
                                
                                    <tbody>
                                    <tr class="unread">
                                        <td class=""><a href=""> <?php echo $rwrecord['id'];?></a></td>
                                        <td><a><?php echo $rwrecord['nama_barang'];?></a></td>
                                        <td><a href="#"><?php echo $rwrecord['deskripsi'];?></a>
                                        </td>
                                        <td><a href=""><?php echo $rwrecord['nama_supplier'];?></a></td>
                                        <td class="text-right mail-date"><?php echo $rwrecord['tgl_visit'];?></td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                   <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="">
                                            <a href=""> 1</a>
                                        </td>
                                        <td><a>Fenel Oil</a></td>
                                        <td><a href="#">Good product and can make you feel hot.</a>
                                        </td>
                                        <td><a href="">Andika</a></td>
                                        <td class="text-right mail-date">Tue, Nov 25</td>
                                    </tr>
                                    
                                </tbody>                             
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <?php
}
?>