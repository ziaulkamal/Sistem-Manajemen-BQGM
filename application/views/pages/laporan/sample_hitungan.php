<?php

$dateNow = strtotime(date('Y-m-d'));
$no = 1;
foreach ($data as $r ) {
if ($r->tenor == 5 && $r->sisaTenor == 5 && !empty($r->ansuranKelima)) { 
if ($dateNow >= strtotime($r->angsuranPertama)) { ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranPertama ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 4 && !empty($r->angsuranKeempat)) { 

if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranPertama ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 3 && !empty($r->angsuranKetiga)) { 

if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranPertama ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 2 && !empty($r->angsuranKedua)) { 

if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranPertama ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 1 && $r->sisaTenor == 1 && !empty($r->angsuranPertama)) { 

if ( $dateNow >= strtotime($r->angsuranPertama)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranPertama ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}

if ($r->tenor == 5 && $r->sisaTenor == 4 && !empty($r->ansuranKelima)) { 
if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKedua ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 && !empty($r->angsuranKeempat)) { 

if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKedua ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 && !empty($r->angsuranKetiga)) { 

if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKedua ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 2 && $r->sisaTenor == 1 && !empty($r->angsuranKedua)) { 

if ( $dateNow >= strtotime($r->angsuranKedua)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKedua ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}

if ($r->tenor == 5 && $r->sisaTenor == 3 && !empty($r->ansuranKelima)) { 

if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKetiga ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 3 && !empty($r->angsuranKeempat)) { 

if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKetiga ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 3 && $r->sisaTenor == 2 && !empty($r->angsuranKetiga)) { 

if ( $dateNow >= strtotime($r->angsuranKetiga)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKetiga ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}

if ($r->tenor == 5 && $r->sisaTenor == 2 && !empty($r->ansuranKelima)) { 

if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKeempat ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}elseif ($r->tenor == 4 && $r->sisaTenor == 1 && !empty($r->angsuranKeempat)) { 

if ( $dateNow >= strtotime($r->angsuranKeempat)) { ?><tr>
<td><?= $no++ ?></td>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->angsuranKeempat ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}

if ($r->tenor == 5 && $r->sisaTenor == 1 && !empty($r->ansuranKelima)) { 

if ( $dateNow >= strtotime($r->ansuranKelima)) { ?>
<td><?= $r->id_pinjaman ?></td>
<td><?= $r->id_anggota ?></td>
<td><?= $r->namaAnggota ?></td>
<td><?= $r->plafon ?></td>
<td><?= $r->tenor ?></td>
<td><?= $r->sisaTenor ?></td>
<td><?= $r->ansuranKelima ?></td>
<td><?= $r->namaLengkap ?></td>
</tr>
<?php }}
}

?>