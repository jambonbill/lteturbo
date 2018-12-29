<div class="col-md-4">
<?php

$htm='<ul class="nav flex-column">';
$htm.='<li class="nav-item">';
    $htm.='<a href="#" class="nav-link">Projects <span class="float-right badge bg-primary">31</span></a>';
  $htm.='</li>';
  $htm.='<li class="nav-item">';
    $htm.='<a href="#" class="nav-link">Tasks <span class="float-right badge bg-info">5</span></a>';
  $htm.='</li>';
  $htm.='<li class="nav-item">';
    $htm.='<a href="#" class="nav-link">Completed Projects <span class="float-right badge bg-success">12</span></a>';
  $htm.='</li>';
  $htm.='<li class="nav-item">';
    $htm.='<a href="#" class="nav-link">Followers <span class="float-right badge bg-danger">842</span></a>';
  $htm.='</li>';
$htm.='</ul>';

$card=new LTE\Card;
//$card->header('header');
$card->body('body');
$card->footer($htm);
//$card->loading(1);
echo $card;
?>
</div>

<div class="col-md-4">

  <!-- Widget: user widget style 2 -->
  <div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-warning">
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="../dist/img/user7-128x128.jpg" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username">Nadia Carmichael</h3>
      <h5 class="widget-user-desc">Lead Developer</h5>
    </div>

    <div class="card-footer p-0">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a href="#" class="nav-link">
            Projects <span class="float-right badge bg-primary">31</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            Tasks <span class="float-right badge bg-info">5</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            Completed Projects <span class="float-right badge bg-success">12</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            Followers <span class="float-right badge bg-danger">842</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->
</div>
<!-- /.col -->



  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-info-active">
        <h3 class="widget-user-username">Alexander Pierce</h3>
        <h5 class="widget-user-desc">Founder & CEO</h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">3,200</h5>
              <span class="description-text">SALES</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 border-right">
            <div class="description-block">
              <h5 class="description-header">13,000</h5>
              <span class="description-text">FOLLOWERS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <div class="description-block">
              <h5 class="description-header">35</h5>
              <span class="description-text">PRODUCTS</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->
