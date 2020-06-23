<footer>
    <div class="container">
    <div class="copyright">All rights reserved. DZYDO. </div>
    </div>
</footer>
<?php if (isset($scripts)):?>
<?php foreach ($scripts as $sript):?>
<script src="/js/<?php echo $sript;?>.js"></script>
<?php endforeach;?>
<?php endif;?>
</body>
</html>
