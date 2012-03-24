<?php

/**
 * Description of ArtistFilter
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ArtistFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        if (isset (u()->artistPending))
        {
            c()->setFlashInfo(t('Molimo vas upotpunite vaš umetnički profil.'));
            c()->redirect(array('/artist/edit'));
        }
        return true;
    }
}