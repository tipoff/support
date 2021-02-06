<?php

return [

    'model_class' => [

        'block' => \Tipoff\Scheduling\Models\Block::class,

        'booking' => \Tipoff\Bookings\Models\Booking::class,

        'cart' => \Tipoff\Checkout\Models\Cart::class,

        'cart_item' => \Tipoff\Checkout\Models\CartItem::class,

        'competitor' => \Tipoff\Reviews\Models\Competitor::class,

        'contact' => \App\Models\Contact::class,

        'customer' => \Tipoff\Addresses\Models\Customer::class, // Will be renamed later to address when new features added

        'discount' => \App\Models\Discount::class,

        'fee' => \Tipoff\Fees\Models\Fee::class,

        'feedback' => \App\Models\Feedback::class,

        'flex_day' => \Tipoff\FlexScheduling\Models\FlexDay::class,

        'game' => \Tipoff\Scheduling\Models\Game::class,

        'hold' => \Tipoff\Scheduling\Models\Hold::class,

        'image' => \DrewRoberts\Media\Models\Image::class,

        'insight' => \Tipoff\Reviews\Models\Insight::class,

        'invoice' => \Tipoff\Invoices\Models\Invoice::class,

        'key' => \Tipoff\Reviews\Models\Key::class,

        'location' => \Tipoff\Locations\Models\Location::class,

        'market' => \Tipoff\Locations\Models\Market::class,

        'note' => \Tipoff\Notes\Models\Note::class,

        'order' => \Tipoff\Checkout\Models\Order::class,

        'order_item' => \Tipoff\Checkout\Models\OrderItem::class,

        'page' => \DrewRoberts\Blog\Models\Page::class,

        'participant' => \App\Models\Participant::class,

        'payment' => \Tipoff\Payments\Models\Payment::class,

        'post' => \DrewRoberts\Blog\Models\Post::class,

        'rate' => \Tipoff\EscapeRoom\Models\Rate::class,

        'recurring_schedule' => \Tipoff\Scheduling\Models\RecurringSchedule::class,

        'refund' => \Tipoff\Refunds\Models\Refund::class,

        'review' => \Tipoff\Reviews\Models\Review::class,

        'room' => \Tipoff\EscapeRoom\Models\Room::class,

        'schedule' => \App\Models\Schedule::class,

        'schedule_eraser' => \Tipoff\Scheduling\Models\ScheduleEraser::class,

        'series' => \DrewRoberts\Blog\Models\Series::class,

        'signature' => \Tipoff\Waivers\Models\Signature::class,

        'slot' => \Tipoff\Scheduling\Models\Slot::class,

        'snapshot' => \Tipoff\Reviews\Models\Snapshot::class,

        'status' => \Tipoff\Statuses\Models\Status::class,

        'supervision' => \Tipoff\EscapeRoom\Models\Supervision::class,

        'tag' => \DrewRoberts\Media\Models\Tag::class,

        'tax' => \Tipoff\Taxes\Models\Tax::class,

        'theme' => \Tipoff\EscapeRoom\Models\Theme::class,

        'topic' => \DrewRoberts\Blog\Models\Topic::class,

        'user' => \App\Models\User::class,

        'video' => \DrewRoberts\Media\Models\Video::class,

        'voucher' => \Tipoff\Vouchers\Models\Voucher::class,

        'voucher_type' => \Tipoff\Vouchers\Models\VoucherType::class,

    ]

];
