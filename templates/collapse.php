<?php
######################## COLLAPSE DATA MASTER ########################
if ($page == "User" || $page == "Mahasiswa" || $page == "Nilai" || $page == "Relasi" || $page == "Kelas" || $page == "Jurusan") {
    $collapse1 = "<li class='nav-item active'>
                <a class='nav-link' href='#' data-toggle='collapse' data-target='#datamaster' aria-expanded='true' aria-controls='datamaster'>
                    <i class='fas fa-fw fa-server'></i>
                    <span>Data Master</span>
                </a>
            <div id='datamaster' class='collapse show' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
} else {
    $collapse1 = "<li class='nav-item'>
                <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#datamaster' aria-expanded='true' aria-controls='datamaster'>
                    <i class='fas fa-fw fa-server'></i>
                    <span>Data Master</span>
                </a>
            <div id='datamaster' class='collapse' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
}

//////////////////// MENU DATA MASTER
if ($page == "User") {
    $list1_item1 = "collapse-item active";
} else {
    $list1_item1 = "collapse-item";
}

if ($page == "Mahasiswa") {
    $list1_item2 = "collapse-item active";
} else {
    $list1_item2 = "collapse-item";
}

if ($page == "Nilai") {
    $list1_item3 = "collapse-item active";
} else {
    $list1_item3 = "collapse-item";
}

if ($page == "Relasi") {
    $list1_item4 = "collapse-item active";
} else {
    $list1_item4 = "collapse-item";
}

if ($page == "Kelas") {
    $list1_item5 = "collapse-item active";
} else {
    $list1_item5 = "collapse-item";
}


######################## COLLAPSE STATUS ########################
if ($page == "Kerja" || $page == "Magang" || $page == "Free" || $page == "Gugur") {
    $collapse2 = "<li class='nav-item active'>
                <a class='nav-link' href='#' data-toggle='collapse' data-target='#status' aria-expanded='true' aria-controls='status'>
                    <i class='fas fa-users'></i>
                    <span>Status</span>
                </a>
            <div id='status' class='collapse show' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
} else {
    $collapse2 = "<li class='nav-item'>
                <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#status' aria-expanded='true' aria-controls='status'>
                    <i class='fas fa-users'></i>
                    <span>Status</span>
                </a>
            <div id='status' class='collapse' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
}

//////////////////// MENU STATUS
if ($page == "Kerja") {
    $list2_item1 = "collapse-item active";
} else {
    $list2_item1 = "collapse-item";
}

if ($page == "Magang") {
    $list2_item2 = "collapse-item active";
} else {
    $list2_item2 = "collapse-item";
}

if ($page == "Free") {
    $list2_item3 = "collapse-item active";
} else {
    $list2_item3 = "collapse-item";
}

if ($page == "Gugur") {
    $list2_item4 = "collapse-item active";
} else {
    $list2_item4 = "collapse-item";
}


######################## COLLAPSE PENGAJUAN ########################
if ($page == "Pengajuan" || $page == "Konfirmasi") {
    $collapse3 = "<li class='nav-item active'>
                <a class='nav-link' href='#' data-toggle='collapse' data-target='#pengajuan' aria-expanded='true' aria-controls='pengajuan'>
                    <i class='fas fa-clipboard'></i>
                    <span>Pengajuan</span>
                </a>
            <div id='pengajuan' class='collapse show' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
} else {
    $collapse3 = "<li class='nav-item'>
                <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#pengajuan' aria-expanded='true' aria-controls='pengajuan'>
                    <i class='fas fa-clipboard'></i>
                    <span>Pengajuan</span>
                </a>
            <div id='pengajuan' class='collapse' aria-labelledby='headingPages' data-parent='#accordionSidebar'>";
}

//////////////////// MENU PENGAJUAN
if ($page == "Pengajuan") {
    $list3_item1 = "collapse-item active";
} else {
    $list3_item1 = "collapse-item";
}

if ($page == "Konfirmasi") {
    $list3_item2 = "collapse-item active";
} else {
    $list3_item2 = "collapse-item";
}
