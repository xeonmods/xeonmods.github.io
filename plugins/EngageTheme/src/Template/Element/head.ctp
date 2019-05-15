<head>
    <?= $this->Html->charset(); ?>
    <title><?= $this->element('head_title') ?></title>
    <?php 
        // Meta Viewport
        echo $this->Html->meta(
            'viewport',
            'width=device-width, initial-scale=1'
        );

        // Meta Author
        echo $this->Html->meta(
            'author',
            $siteName
        );

        // Meta Keywords
        echo $this->Html->meta(
            'keywords',
            $metaKeywords
        );

        // Meta Description
        echo $this->Html->meta(
            'description',
            $metaDescription
        );
        
        // Meta Open Graph
        echo $this->element('Meta/open_graph');

        // Meta Twitter
        echo $this->element('Meta/twitter') 
    ?>

    <link rel="canonical" href="<?= $this->Url->build($this->request->getRequestTarget(), true) ?>">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,700" rel="stylesheet">

    <!-- Font Awesome 4.7 -->
    <?= $this->Html->css('font-awesome.min.css') ?>

    <!-- Bootstrap -->
    <?= $this->Html->css('bootstrap.min.css') ?>
    <!-- Froala Blocks -->
    <?= $this->Html->css('/master-assets/plugins/froala-blocks/css/froala_blocks.css') ?>
    <!-- UI Kit -->
    <?= $this->Html->css('/master-assets/plugins/uikit/css/uikit.css') ?>
    <!-- Parsley -->
    <?= $this->Html->css('/master-assets/plugins/parsley/src/parsley.css') ?>

    <?= $this->Html->css('/master-assets/css/bttn.css') ?>
    <?= $this->Html->css('custom.css') ?>

    <?php if ($favicon != ''): ?>
    <!-- Favicon -->
    <link rel="icon" href="<?= $this->request->getAttribute("webroot").'uploads/images/original/' . $favicon ?>">
    <?php else: ?>
    <!-- Favicon -->
    <link rel="icon" href="<?= $this->request->getAttribute("webroot").'master-assets/img/favicon.png' ?>">
    <?php endif; ?>

    <!-- jQuery -->
    <?= $this->Html->script('jquery-3.3.1.min.js'); ?>

    <?php if ($formSecurity == 'on'): ?>
    <!-- Google reCaptcha -->
    <?= $this->Html->script('https://www.google.com/recaptcha/api.js?render='.$recaptchaSitekey); ?>
    <?php endif; ?>

    <!-- Schema.org ld+json -->
    <?php
        if ($this->request->getParam('action') == 'home') {
            echo html_entity_decode($ldJsonWebsite);
            echo html_entity_decode($ldJsonOrganization);
        }

        // WebPage
        if (isset($webpageSchema)) {
            echo html_entity_decode($webpageSchema);
        }
        
        // BreadcrumbList
        if (isset($breadcrumbSchema)) {
            echo html_entity_decode($breadcrumbSchema);
        }

        // Article
        if (isset($articleSchema)) {
            echo html_entity_decode($articleSchema);
        }
    ?>

    <script type="text/javascript">
        var cakeDebug    = "<?= $cakeDebug ?>",
            formSecurity = "<?= $formSecurity ?>";
        window.cakeDebug    = cakeDebug;
        window.formSecurity = formSecurity;
    </script>
</head>