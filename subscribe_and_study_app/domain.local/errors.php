<?php if (count($errors) > 0) : ?>
    <div class="alert alert-warning" role="alert">
        <div class="container">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?><?php
