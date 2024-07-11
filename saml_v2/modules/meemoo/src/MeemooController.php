<?php

namespace SimpleSAML\Module\meemoo;

use Twig\Environment;
use SimpleSAML\XHTML\TemplateControllerInterface;

class MeemooController implements TemplateControllerInterface
{
    /**
     * Modify the twig environment after its initialization (e.g. add filters or extensions).
     *
     * @param \Twig\Environment $twig The current twig environment.
     * @return void
     */
    public function setUpTwig(Environment &$twig): void
    {
    }

    /**
     * Add, delete or modify the data passed to the template.
     *
     * This method will be called right before displaying the template.
     *
     * @param array $data The current data used by the template.
     * @return void
     */
    public function display(array &$data): void
    {
        # use SSUM_ENV var
        $ssum_url = getenv('SSUM_URL');
        if ($ssum_url == false) {
            $ssum_url = "https://ssum-tst-iam.private.cloud.meemoo.be";
        }

        # added for having a redirectTo on the password forget link
        $data['ssumUrl'] = $ssum_url;

        $state = $data['app_state'];

        if (isset($state['\\SimpleSAML\\Auth\\State.restartURL'])) {
          $t->data['redirectTo'] = urlencode($state['\\SimpleSAML\\Auth\\State.restartURL']);
        } else {
          $t->data['redirectTo'] = '/';
        }

        # TODO: inside our redirectTo we also have a &language now that we can use to set locale
        # $data['extra_info'] = 'Extra information to use in your template';
    }
}

