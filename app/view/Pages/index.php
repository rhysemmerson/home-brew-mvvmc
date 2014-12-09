<?php
$this->Assets->enqueueScript(['bootstrap', 'datepicker']);
$this->Assets->enqueueStyle(['font-awesome', 'default']);
?>

<?php $this->Blocks->start('nav', 'append') ?>
<ul class="nav navbar-nav navbar-right">
    <li class=""><a href="#contact"><span class="fa fa-user"></span>&nbsp;Login</a></li>
</ul>
<?php $this->Blocks->end() ?>


<div class="container">
    <div class="starter-template text-center">
        <h1>Bootstrap starter template</h1>
        <p class="lead text-center">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
        <p>Here's some generator generated content</p>
        <ul>
            <?php
            
            ?>
        </ul>
    </div>

</div><!-- /.container -->

