<?php
    $qrecord = "SELECT * FROM `t_tea`";
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
                                    <?php
                                        $no=1;
                                        $qrecord = "SELECT * FROM `t_tea`";
                                        $rrecord = mysqli_query($konek, $qrecord);
                                       while($rwrecord = mysqli_fetch_array($rrecord))
                                        {
                                    ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><a href="tea_document.php"><strong><?php echo $rwrecord['product_name'];?></strong></a></td>
                                                <td><?php echo $rwrecord['description'];?></td>
                                                <td><?php echo $rwrecord['supplier'];?></td>
                                                <td><?php echo $rwrecord['visit_date'];?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    
                                    
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