<?php

    function dataToko()
    {
        // Rating Toko
        $banyak_rating = \Auth::user()->suggestion->count('rating');
        $jumlah_rating = \Auth::user()->suggestion->sum('rating');
        $total_rating = $jumlah_rating / $banyak_rating;
        $pembulatan_rating = round($total_rating);
    }

?>