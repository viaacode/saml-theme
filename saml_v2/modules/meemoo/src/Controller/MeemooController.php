<?php

namespace SimpleSAML\Module\meemoo\Controller;

/* use SimpleSAML\{Configuration, Logger, Session}; */
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


	      # compute redirectTo and optionally set locale
        $form_parts = parse_url($data['formURL']);
        parse_str($form_parts['query'], $form_query);
        $auth_state = $form_query['AuthState'];
        $auth_parts = explode('https://', $auth_state);

        if (count($auth_parts) == 2 ) {
          $redirect_url = "https://".$auth_parts[1];
        }
        else {
          $redirect_url = "/";
        }

	      $data['redirectTo'] = $redirect_url;

        # TODO: now get our language inside the redirect_url params and set it if its available.
    }
}

