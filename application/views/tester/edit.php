<div id="editor">
  <?php echo $content;?>
</div>
    
<script src="<?php echo site_url('public');?>/ace/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo site_url('public');?>/ace/ext-static_highlight.js"></script>

<script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
</script>
