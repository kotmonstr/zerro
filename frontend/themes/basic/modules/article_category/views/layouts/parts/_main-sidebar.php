<?php
use yii\helpers\Url;
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/LTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce2</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Главное меню управления</li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>



            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Товары</span>
                    <span class="label label-primary pull-right from20-px-mr">4</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Просмотреть все</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Добавить</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Редактировать</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Статьи</span>
                    <span class="label label-primary pull-right from20-px-mr"><?= $this->context->countallArticles ?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= Url::to('/article/show') ?>"><i class="fa fa-circle-o"></i> Просмотреть все</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Добавить</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Редактировать</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Категории статей</span>
                    <span class="label label-primary pull-right from20-px-mr">4</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Просмотреть все</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Добавить</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Редактировать</a></li>

                </ul>
            </li>            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Категории товаров</span>
                    <span class="label label-primary pull-right from20-px-mr">4</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> Просмотреть все</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Добавить</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Редактировать</a></li>

                </ul>
            </li>



            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>