<?php
/**
 * Title: Single Form component
 * Slug: aname/singleForm
 * Inserter: no
 * Used for leads catching in website.
 *
 * @package aname
 * @since 1.0.0
 * @updated 24.2.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

//phpcs:disable WordPress.Security.EscapeOutput.UnsafePrintingFunction
//phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
//phpcs:disable WordPress.WhiteSpace.PrecisionAlignment.Found

$inputs = array(
    array(
        'id'          => 'fname',
        'name'        => 'fname',
        'title'       => __( 'Your Name', 'aname' ),
        'placeholder' => true,
        'require'     => true,
        'type'        => 'text',
    ),
    array(
        'id'          => 'phone',
        'name'        => 'phone',
        'title'       => __( 'Your Phone', 'aname' ),
        'placeholder' => true,
        'require'     => true,
        'type'        => 'text',
    ),
    array(
        'id'          => 'email',
        'name'        => 'email',
        'title'       => __( 'Your Email', 'aname' ),
        'placeholder' => true,
        'require'     => true,
        'type'        => 'email',
    ),
);

?>
<form action="#" class="quick-form" id="cta_cform">

    <div class="inputs-hidden" aria-hidden="true">
        <label for="hfullname"><?php _e( 'Your Name', 'aname' ); ?></label>
        <input class="fullname" id="hfullname" name="fullname" size="40" type="text"/>
    </div>

    <div class="inputs">
        <input type="hidden" name="post_name" value="<?php echo get_the_title(); ?>">
        <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
        <input type="hidden" name="action" value="sendForm"/>


        <?php foreach ( $inputs as $input ) : ?>
            <div class="single-input">
                <label for="<?php echo $input['id']; ?>" class="sr-only">
                    <?php echo $input['title']; ?>
                </label>
                <input id="<?php echo $input['id']; ?>"
                       name="<?php echo $input['name']; ?>"
                       type="text" <?php echo ( $input['require'] ) ? 'required' : ''; ?>
                       placeholder="<?php echo ( $input['title'] ) ? $input['title'] : ''; ?>*"
                >
            </div>
        <?php endforeach; ?>
        <div class="single-input text-input">
            <label for="msg" class="sr-only">
                <?php _e( 'Your Message', 'aname' ); ?>
            </label>
            <textarea id="msg" name="msg" cols="30" rows="4"
                      placeholder="<?php _e( 'Your Message', 'aname' ); ?>"
            ></textarea>
        </div>
        <div class="single-input">
            <button type="submit"><?php _e( 'Send', 'aname' ); ?></button>
        </div>
    </div>
</form>

<div class="result"></div>
