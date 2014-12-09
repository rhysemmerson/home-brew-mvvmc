<?php
$this->Assets->enqueueScript('bootstrap-datepicker');
$this->Assets->enqueueScript('bootstrap');
?>

<?php
$this->Blocks->set('title', 'Unauthorized');
$this->Blocks->append('nav', '<li>Unauthorized</li>');
$this->Blocks->append('nav', '<li>Somethin</li>');
?>

<h1>It worked!</h1>

<?php echo $content; ?>

<h3>Here's a list from HtmlHelper</h3>
<?php echo $this->Html->unorderedList(['Milk', 'Eggs', 'Bread', 'Eye of newt']); ?>

<?php $this->Blocks->start('scripts') ?>
<script type="text/javascript">
//    alert('woohoo!');
</script>
<?php $this->Blocks->end() ?>