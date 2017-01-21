/**
 * Created by Jerome Lelievre on 19/01/2017.
 */
/*global $*/
$(document).ready(function () {
    "use strict";
    $('.listContact .btnViewContact').click(function () {
        var allBlockPreview = $('.previewContact'),
            blockContactElement = this.parentNode.parentNode.parentNode.parentNode,
            contactInformation = {},
            blockPreview = this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.previousSibling.previousElementSibling;

        // Si l'id du contact a afficher n'est pas le même que celui actuellement affiché en zone preview
        if ($(blockContactElement).attr('id') !== $(blockPreview).attr('data-contactid')) {
            // Enleve la class disabled a tous les boutons affichant un preview du contact et set sur le bouton cliqué
            $('button.btnViewContact').removeClass("disabled");
            $(this).addClass("disabled");

            // Stock les informations du contact à afficher
            contactInformation.names = $(blockContactElement).find("h3")[0].textContent;
            contactInformation.email = '<a href="mailto:' + $(blockContactElement).find('.is_hidden .emailContact')[0].textContent + '">' + $(blockContactElement).find('.is_hidden .emailContact')[0].textContent + '</a>';
            contactInformation.birthdate = $(blockContactElement).find('.is_hidden .birthdateContact')[0].textContent;
            contactInformation.avatarSrc = $(blockContactElement).find("img").attr('src');
            contactInformation.adresse = $(blockContactElement).find('.is_hidden .adresseContact')[0].textContent;
            contactInformation.telephone = '<a href="tel:' + $(blockContactElement).find('.is_hidden .telephoneContact')[0].textContent + '">' + $(blockContactElement).find('.is_hidden .telephoneContact')[0].textContent + '</a>';
            contactInformation.siteWeb = '<a href="' + $(blockContactElement).find('.is_hidden .siteWebContact')[0].textContent + '">' + $(blockContactElement).find('.is_hidden .siteWebContact')[0].textContent + '</a>';

            //  Set le data attribute sur la ligne preview concernée et reset les non concernées
            $(allBlockPreview).attr('data-contactid', '');
            $(blockPreview).attr('data-contactid', $(blockContactElement).attr('id'));

            // Masque les lignes de preview non concernées
            $(allBlockPreview).slideUp('fast', function () {
                setTimeout(function(){
                    // Remplis la zone de preview
                    $(blockPreview).find('h3')[0].textContent = contactInformation.names;
                    $(blockPreview).find('.previewBirthdateContact span.content')[0].textContent = contactInformation.birthdate;
                    $(blockPreview).find('.previewEmailContact span.content')[0].innerHTML = contactInformation.email;
                    $(blockPreview).find('img').attr('src', contactInformation.avatarSrc);
                    $(blockPreview).find('.previewAdresseContact span.content')[0].textContent = contactInformation.adresse;
                    $(blockPreview).find('.previewTelephoneContact span.content')[0].innerHTML = contactInformation.telephone;
                    $(blockPreview).find('.previewSiteWebContact span.content')[0].innerHTML = contactInformation.siteWeb;
                }, 200);
            });

            // affiche la ligne de preview concernées
            $(blockPreview).slideDown('slow');
        }
    });
});