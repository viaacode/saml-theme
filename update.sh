#!/usr/bin/env bash
# Create environment specific files based on the template
# Run this script before committing changes

function account_portal_url {
    case $1 in
        "hetarchief")
            case $2 in
                production)
                    Url="https://account.hetarchief.be/users/password/new?redirect_to=";;
                staging)
                    Url="https://account-qas.hetarchief.be/users/password/new?redirect_to=";;
                integration)
                    Url="https://ssum-int-iam.private.cloud.meemoo.be/users/password/new?redirect_to=";;
                development)
                    Url="https://ssum-tst-iam.private.cloud.meemoo.be/users/password/new?redirect_to=";;
            esac
            ;;
        *)
            case $2 in
                production)
                    Url="https://accounts.viaa.be/pwm/public/ForgottenPassword";;
                staging)
                    Url="https://accounts-qas.viaa.be/pwm/public/ForgottenPassword";;
                *)
                    Url="https://accounts-qas.viaa.be/pwm/public/ForgottenPassword";;
            esac
            ;;
    esac
    echo $Url
}

cd themes
for Theme in *; do
    for Env in integration development production staging; do
        Dirname=".${Theme}-${Env}"
        [ -d "$Dirname" ] || mkdir $Dirname
        cd $Theme
        SsumUrl=$(account_portal_url $Theme $Env)
        find . -type d | cpio -pvd ../$Dirname 2>/dev/null
        find . -type f | while read File; do
           echo "Processing $File"
           sed -r -s \
               -e "s|%%SSUM_URL%%|$SsumUrl|g" -e "s|%%ENV%%|$Env|g" $File \
               >../$Dirname/$File
       done
       cd ..
   done
done
