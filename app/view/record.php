<?php /* @var array $params */ ?>
<?php \Lib\View\ViewManager::show('header', ['title' => $params['title']]); ?>

<form class="pt-4">
    <?php foreach ($params['result'] as $item): ?>
        <?php switch ($item['type']):
            case 'text':?>
                <div class="mb-3">
                    <label for="input<?=$item['code']?>" class="form-label"><?=$item['name']?></label>
                    <input type="email" class="form-control <?=isset($item['error'])? 'is-invalid' : ''?>" placeholder="<?=$item['name']?>" id="input<?=$item['code']?>" aria-describedby="<?=$item['code']?>Help" value="<?=$item['value'] ?? ''?>" required>
					<?php if (isset($item['error'])):?>
                        <div id="<?=$item['code']?>Help" class="invalid-feedback"><?=$item['error']?></div>
					<?php endif;?>
                </div>
            <?php break;?>
        <?php endswitch;?>
    <?php endforeach;?>
    <button type="submit" class="btn btn-dark">Submit</button>
</form>

<?php \Lib\View\ViewManager::show('footer'); ?>
