<?php /* @var array $params */ ?>
<?php \Lib\View\ViewManager::show('header', ['title' => $params['title']]); ?>

<form class="pt-4" method="post" action="<?=$params['result']['action']?>">
    <?php foreach ($params['result']['items'] as $item): ?>
            <?php if ($item['code'] == 'id'):?>
                <input type="hidden" name="id" value="<?=$item['value']?>">
            <?php else:?>
            <div class="mb-3">
                <label for="input<?=$item['code']?>" class="form-label"><?=$item['name']?></label>
                <input type="text" class="form-control <?=isset($item['error'])? 'is-invalid' : ''?>" placeholder="<?=$item['name']?>" name="<?=$item['code']?>" id="input<?=$item['code']?>" aria-describedby="<?=$item['code']?>Help" value="<?=$item['value'] ?? ''?>" required>
                <?php if (isset($item['error'])):?>
                    <div id="<?=$item['code']?>Help" class="invalid-feedback"><?=$item['error']?></div>
                <?php endif;?>
            </div>
            <?php endif;?>
    <?php endforeach;?>
    <button type="submit" class="btn btn-dark">Отправить</button>
</form>

<?php \Lib\View\ViewManager::show('footer'); ?>
