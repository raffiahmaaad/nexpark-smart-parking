<?php

use Illuminate\Support\Facades\Auth;

/**
 * MAKE AVATAR FUNCTION
 */
if (!function_exists('makeAvatar')) {

    function makeAvatar($fontPath, $dest, $char)
    {
        $path = $dest;
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);

        // Add some shadow to the text
        imagettftext($image, 110, 0, 51, 151, $textcolor, $fontPath, $char);
        // Add the text
        imagettftext($image, 105, 0, 50, 150, $textcolor, $fontPath, $char);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
}

if (!function_exists('createUserAvatar')) {
    function createUserAvatar($request)
    {
        $path = 'users/avatars/';
        $fontPath = public_path('fonts/Oliciy.ttf');
        $char = strtoupper($request->name[0]);
        $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
        $dest = $path . $newAvatarName;

        $createAvatar = makeAvatar($fontPath, $dest, $char);
        $picture = $createAvatar == true ? $newAvatarName : '';

        return $picture;
    }
}

if (!function_exists('is_Admin')) {
    function is_Admin()
    {
        return Auth::check() && Auth::user()->role_id == 1;
    }
}

/**
 * GET READ UNREAD ICON TICKS
 */
if (!function_exists('getUnseenSeenIcon')) {
    function getUnseenSeenIcon($is_seen)
    {
        switch ($is_seen) {
            case '0':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck" x="2047" y="2061"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#92a58c"/></svg>';
            case '1':
                return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-dblcheck-ack" x="2063" y="2076"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#4fc3f7"/></svg>';
            default:
                # code...
                break;
        }
    }
}

if (!function_exists('getOfflineUnseenSeenIcon')) {
    function getOfflineUnseenSeenIcon()
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" id="msg-check" x="2047" y="2061"><path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z" fill="#92a58c"/></svg>';
    }
}

if (!function_exists('getVehicleStatus')) {
    function getVehicleStatus()
    {
        return [
            0 => 'InActive',
            1 => 'Ongoing',
            2 => 'Completed',
            3 => 'Cancelled'
        ];
    }
}

if (!function_exists('getParkingareas')) {
    function getParkingareas()
    {
        return ['' => 'Select', 'Blok A' => 'Blok A', 'Blok B' => 'Blok B', 'Blok C' => 'Blok C'];
    }
}

if (!function_exists('projectStatusLabel')) {
    function projectStatusLabel($status)
    {
        switch ($status) {
            case 1:
                return 'fas fa-star fa-2x text-info';
            case 2:
                return 'fas fa-star fa-2x text-warning';
            case 3:
                return 'fas fa-star fa-2x text-success';
            default:
            case 0:
                return 'fas fa-star fa-2x text-danger';
        }
    }
}

if (!function_exists('vehicleStatusValue')) {
    function vehicleStatusValue($status)
    {
        switch ($status) {
            case 1:
                return 'Ongoing';
            case 2:
                return 'Completed';
            case 3:
                return 'Cancelled';
            default:
            case 0:
                return 'InActive';
        }
    }
}
