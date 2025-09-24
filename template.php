<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arResult */
?>

<?php if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<div class="contact-form">

    <?= $arResult["FORM_NOTE"] ?? '' ?>

    <?php if ($arResult["isFormNote"] != "Y"): ?>
        <?=$arResult["FORM_HEADER"]?>

        <?php if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y"): ?>
            <div class="contact-form__head">
                <?php if ($arResult["isFormTitle"]): ?>
                    <div class="contact-form__head-title"><?=$arResult["FORM_TITLE"]?></div>
                <?php endif; ?>

                <?php if ($arResult["isFormDescription"]): ?>
                    <div class="contact-form__head-text"><?=$arResult["FORM_DESCRIPTION"]?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="contact-form__form">
            <div class="contact-form__form-inputs">
                <?php foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion): ?>
                    <?php if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'): ?>
                        <?=$arQuestion["HTML_CODE"]?>
                    <?php elseif ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea' || $FIELD_SID == 'message'): ?>
                    <?php else: ?>
                        <div class="contact-form__input">
                            <label class="input__label" for="<?=$FIELD_SID?>">
                                <div class="input__label-text">
                                    <?=$arQuestion["CAPTION"]?>
                                    <?php if ($arQuestion["REQUIRED"] == "Y"): ?>
                                        <?=$arResult["REQUIRED_SIGN"];?>
                                    <?php endif; ?>
                                </div>
                                <div class="input__field">
                                    <?=$arQuestion["HTML_CODE"]?>
                                </div>
                            </label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <?php
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea' || $FIELD_SID == 'message'): ?>
                    <div class="contact-form__form-message">
                        <div class="input">
                            <label class="input__label" for="<?=$FIELD_SID?>">
                                <div class="input__label-text">
                                    <?=$arQuestion["CAPTION"]?>                                    
                                    <?php if ($arQuestion["REQUIRED"] == "Y"): ?>
                                        <?=$arResult["REQUIRED_SIGN"];?>
                                    <?php endif; ?>
                                </div>
                                <div class="input__field"><?=$arQuestion["HTML_CODE"]?></div>
                            </label>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;
            ?>


            <div class="contact-form__bottom">
                <div class="contact-form__bottom-policy">
                    Нажимая &laquo;<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>&raquo;, Вы&nbsp;подтверждаете, что ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных данных&raquo;.
                </div>
                <input
                        type="submit"
                        name="web_form_submit"
                    <?= intval($arResult["F_RIGHT"]) < 10 ? 'disabled' : '' ?>
                        class="form-button contact-form__bottom-button"
                        value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>"
                />

            </div>
        </div>

        <?=$arResult["FORM_FOOTER"]?>
    <?php endif; ?>
</div>
