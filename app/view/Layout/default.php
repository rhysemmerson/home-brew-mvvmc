<?php include 'assets.php' ?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $this->Blocks->get('meta') ?>

        <?php echo $this->Assets->styles(); ?>

        <title><?php echo $this->Blocks->get('title', 'BrainDumpr') . $this->Blocks->get('title2', ' | BrainDumpr') ?></title>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Project name</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <?php $this->Blocks->start('nav', 'prepend') ?>
                    <ul class="nav navbar-nav">
                        <?php echo $this->Blocks->get('inner_nav_start') ?>
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <?php echo $this->Blocks->get('inner_nav_end') ?>
                    </ul>
                    <?php echo $this->Blocks->end(); ?>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <?php echo $content ?>

        <div id="footer">

        </div>

        <?php echo $this->Assets->scripts(); ?>
    </body>
</html>