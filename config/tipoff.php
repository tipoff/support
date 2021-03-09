<?php

return [

    'api' => [
        'enabled' => true,
        'uri_prefix' => 'tipoff',
        'middleware_group' => 'api',
        'auth_middleware' => 'auth',
    ],

    'web' => [
        'enabled' => true,
        'uri_prefix' => 'tipoff',
        'middleware_group' => 'web',
        'auth_middleware' => 'auth',
    ],

    'model_class' => [

        'address' => \Tipoff\Addresses\Models\Address::class,

        'alternate_email' => \Tipoff\Authorization\Models\AlternateEmail::class,

        'block' => \Tipoff\Scheduler\Models\Block::class,

        'booking' => \Tipoff\Bookings\Models\Booking::class,

        'booking_category' => \Tipoff\Bookings\Models\BookingCategory::class,

        'cart' => \Tipoff\Checkout\Models\Cart::class,

        'cart_item' => \Tipoff\Checkout\Models\CartItem::class,

        'city' => \Tipoff\Addresses\Models\City::class,

        'competitor' => \Tipoff\Reviews\Models\Competitor::class,

        'company' => \Tipoff\Seo\Models\Company::class,

        'country' => \Tipoff\Addresses\Models\Country::class,

        'contact' => \Tipoff\Forms\Models\Contact::class,

        'discount' => \Tipoff\Discounts\Models\Discount::class,

        'domain' => \Tipoff\Seo\Models\Domain::class,

        'escape_room_location' => \Tipoff\EscapeRoom\Models\EscapeRoomLocation::class,

        'escape_room_market' => \Tipoff\EscapeRoom\Models\EscapeRoomMarket::class,

        'fee' => \Tipoff\Fees\Models\Fee::class,

        'feedback' => \Tipoff\Feedback\Models\Feedback::class,

        'flex_day' => \Tipoff\FlexScheduling\Models\FlexDay::class,

        'game' => \Tipoff\Scheduler\Models\Game::class,

        'gmb_account' => \Tipoff\GoogleApi\Models\GmbAccount::class,

        'gmb_detail' => \Tipoff\Locations\Models\GmbDetail::class,

        'gmb_hour' =>  \Tipoff\Locations\Models\GmbHour::class,

        'hold' => \Tipoff\Scheduler\Models\Hold::class,

        'image' => \DrewRoberts\Media\Models\Image::class,

        'insight' => \Tipoff\Reviews\Models\Insight::class,

        'invoice' => \Tipoff\Invoices\Models\Invoice::class,

        'key' => \Tipoff\GoogleApi\Models\Key::class,

        'key_agora' => \Tipoff\LaravelAgoraApi\Models\Key::class,

        'key_serp' => \Tipoff\LaravelSerpapi\Models\Key::class,

        'keyword' => \Tipoff\Seo\Models\Keyword::class,

        'location' => \Tipoff\Locations\Models\Location::class,

        'location_payment_setting' => \Tipoff\Payments\Models\LocationPaymentSetting::class,

        'market' => \Tipoff\Locations\Models\Market::class,

        'note' => \Tipoff\Notes\Models\Note::class,

        'order' => \Tipoff\Checkout\Models\Order::class,

        'order_item' => \Tipoff\Checkout\Models\OrderItem::class,

        'page' => \DrewRoberts\Blog\Models\Page::class,

        'participant' => \Tipoff\Bookings\Models\Participant::class,

        'payment' => \Tipoff\Payments\Models\Payment::class,

        'place' => \Tipoff\Seo\Models\Place::class,

        'place_details' => \Tipoff\Seo\Models\PlaceDetails::class,

        'place_hours' => \Tipoff\Seo\Models\PlaceHours::class,

        'post' => \DrewRoberts\Blog\Models\Post::class,

        'product' => \Tipoff\Products\Models\Product::class,

        'profile_link' => \Tipoff\Seo\Models\ProfileLink::class,

        'rate' => \Tipoff\EscapeRoom\Models\Rate::class,

        'ranking' => \Tipoff\Seo\Models\Ranking::class,

        'recurring_schedule' => \Tipoff\Scheduler\Models\RecurringSchedule::class,

        'refund' => \Tipoff\Refunds\Models\Refund::class,

        'region' => \Tipoff\Addresses\Models\Region::class,

        'result' => \Tipoff\Seo\Models\Result::class,

        'review' => \Tipoff\Reviews\Models\Review::class,

        'room' => \Tipoff\EscapeRoom\Models\Room::class,

        'schedule_eraser' => \Tipoff\Scheduler\Models\ScheduleEraser::class,

        'search_volume' => \Tipoff\Seo\Models\SearchVolume::class,

        'series' => \DrewRoberts\Blog\Models\Series::class,

        'signature' => \Tipoff\Waivers\Models\Signature::class,

        'slot' => \Tipoff\Scheduler\Models\Slot::class,

        'snapshot' => \Tipoff\Reviews\Models\Snapshot::class,

        'state' => \Tipoff\Addresses\Models\State::class,

        'status' => \Tipoff\Statuses\Models\Status::class,

        'supervision' => \Tipoff\EscapeRoom\Models\Supervision::class,

        'tag' => \DrewRoberts\Media\Models\Tag::class,

        'tax' => \Tipoff\Taxes\Models\Tax::class,

        'theme' => \Tipoff\EscapeRoom\Models\Theme::class,

        'timezone' => \Tipoff\Addresses\Models\Timezone::class,

        'topic' => \DrewRoberts\Blog\Models\Topic::class,

        'user' => \Tipoff\Authorization\Models\User::class,

        'video' => \DrewRoberts\Media\Models\Video::class,

        'voucher' => \Tipoff\Vouchers\Models\Voucher::class,

        'voucher_type' => \Tipoff\Vouchers\Models\VoucherType::class,

        'webpage' => \Tipoff\Seo\Models\Webpage::class,

        'zip' => \Tipoff\Addresses\Models\Zip::class,

    ],

    'nova_class' => [

        'address' => \Tipoff\Addresses\Nova\Address::class,

        'block' => \Tipoff\Scheduler\Nova\Block::class,

        'booking' => \Tipoff\Bookings\Nova\Booking::class,

        'cart' => \Tipoff\Checkout\Nova\Cart::class,

        'cart_item' => \Tipoff\Checkout\Nova\CartItem::class,

        'city' => \Tipoff\Addresses\Nova\City::class,

        'company' => \Tipoff\Seo\Nova\Company::class,

        'competitor' => \Tipoff\Reviews\Nova\Competitor::class,

        'contact' => \Tipoff\Forms\Nova\Contact::class,

        'country' => \Tipoff\Addresses\Nova\Country::class,

        'discount' => \Tipoff\Discounts\Nova\Discount::class,

        'domain' => \Tipoff\Seo\Nova\Domain::class,

        'escape_room_location' => \Tipoff\EscapeRoom\Nova\EscapeRoomLocation::class,

        'escape_room_market' => \Tipoff\EscapeRoom\Nova\EscapeRoomMarket::class,

        'fee' => \Tipoff\Fees\Nova\Fee::class,

        'feedback' => \Tipoff\Feedback\Nova\Feedback::class,

        'flex_day' => \Tipoff\FlexScheduling\Nova\FlexDay::class,

        'game' => \Tipoff\Scheduler\Nova\Game::class,

        'gmb_account' => \Tipoff\GoogleApi\Nova\GmbAccount::class,

        'image' => \DrewRoberts\Media\Nova\Image::class,

        'insight' => \Tipoff\Reviews\Nova\Insight::class,

        'invoice' => \Tipoff\Invoices\Nova\Invoice::class,

        'key' => \Tipoff\GoogleApi\Nova\Key::class,

        'keyword' => \Tipoff\Seo\Nova\Keyword::class,

        'location' => \Tipoff\Locations\Nova\Location::class,

        'market' => \Tipoff\Locations\Nova\Market::class,

        'note' => \Tipoff\Notes\Nova\Note::class,

        'order' => \Tipoff\Checkout\Nova\Order::class,

        'order_item' => \Tipoff\Checkout\Nova\OrderItem::class,

        'page' => \DrewRoberts\Blog\Nova\Page::class,

        'participant' => \Tipoff\Bookings\Nova\Participant::class,

        'payment' => \Tipoff\Payments\Nova\Payment::class,

        'place' => \Tipoff\Seo\Nova\Place::class,

        'place_details' => \Tipoff\Seo\Nova\PlaceDetails::class,
        
        'place_hours' => \Tipoff\Seo\Nova\PlaceHours::class,

        'post' => \DrewRoberts\Blog\Nova\Post::class,

        'product' => \Tipoff\Products\Nova\Product::class,

        'profile_link' => \Tipoff\Seo\Nova\ProfileLink::class,

        'ranking' => \Tipoff\Seo\Nova\Ranking::class,

        'rate' => \Tipoff\EscapeRoom\Nova\Rate::class,

        'recurring_schedule' => \Tipoff\Scheduler\Nova\RecurringSchedule::class,

        'refund' => \Tipoff\Refunds\Nova\Refund::class,

        'region' => \Tipoff\Addresses\Nova\Region::class,

        'result' => \Tipoff\Seo\Nova\Result::class,

        'review' => \Tipoff\Reviews\Nova\Review::class,

        'room' => \Tipoff\EscapeRoom\Nova\Room::class,

        'schedule_eraser' => \Tipoff\Scheduler\Nova\ScheduleEraser::class,

        'search_volume' => \Tipoff\Seo\Nova\SearchVolume::class,

        'series' => \DrewRoberts\Blog\Nova\Series::class,

        'signature' => \Tipoff\Waivers\Nova\Signature::class,

        'slot' => \Tipoff\Scheduler\Nova\Slot::class,

        'snapshot' => \Tipoff\Reviews\Nova\Snapshot::class,

        'state' => \Tipoff\Addresses\Nova\State::class,

        'status' => \Tipoff\Statuses\Nova\Status::class,

        'supervision' => \Tipoff\EscapeRoom\Nova\Supervision::class,

        'tag' => \DrewRoberts\Media\Nova\Tag::class,

        'tax' => \Tipoff\Taxes\Nova\Tax::class,

        'theme' => \Tipoff\EscapeRoom\Nova\Theme::class,

        'timezone' => \Tipoff\Addresses\Nova\Timezone::class,

        'topic' => \DrewRoberts\Blog\Nova\Topic::class,

        'user' => \Tipoff\Authorization\Nova\User::class,

        'video' => \DrewRoberts\Media\Nova\Video::class,

        'voucher' => \Tipoff\Vouchers\Nova\Voucher::class,

        'voucher_type' => \Tipoff\Vouchers\Nova\VoucherType::class,

        'webpage' => \Tipoff\Seo\Nova\Webpage::class,

        'zip' => \Tipoff\Addresses\Nova\Zip::class,

    ]

];
