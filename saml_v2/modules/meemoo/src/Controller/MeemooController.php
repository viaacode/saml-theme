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

        # fetch platform language from relaystate
        # # TODO: better handle cases where redirect was / or just the language is missing
        $redir_parts = parse_url($redirect_url);
        parse_str($redir_parts['query'], $redir_query);
        $relay_state = $redir_query['RelayState'];

        $relay_data = json_decode($relay_state);
        $platform_language = $relay_data->{'language'};

        # TODO: right now we just set a twig param, however we want to switch global local to platform_language here.
        $data['platform_language'] = $platform_language;

    }
}

