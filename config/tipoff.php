<?php

return [

    'model_class' => [

        'block' => \Tipoff\Scheduling\Models\Block::class,

        'booking' => \App\Models\Booking::class,

        'cart' => \App\Models\Cart::class,

        'cart_item' => \App\Models\CartItem::class,

        'competitor' => \App\Models\Competitor::class,

        'contact' => \App\Models\Contact::class,

        'customer' => \App\Models\Customer::class,

        'discount' => \App\Models\Discount::class,

        'fee' => \Tipoff\Fees\Models\Fee::class,

        'feedback' => \App\Models\Feedback::class,

        'flex_day' => \App\Models\FlexDay::class,

        'game' => \Tipoff\Scheduling\Models\Game::class,

        'hold' => \Tipoff\Scheduling\Models\Hold::class,

        'image' => \DrewRoberts\Media\Models\Image::class,

        'insight' => \App\Models\Insight::class,

        'invoice' => \App\Models\Invoice::class,

        'key' => \App\Models\Key::class,

        'location' => \Tipoff\Locations\Models\Location::class,

        'market' => \Tipoff\Locations\Models\Market::class,

        'note' => \App\Models\Note::class,

        'order' => \App\Models\Order::class,

        'page' => \DrewRoberts\Blog\Models\Page::class,

        'participant' => \App\Models\Participant::class,

        'payment' => \App\Models\Payment::class,

        'post' => \DrewRoberts\Blog\Models\Post::class,

        'rate' => \Tipoff\EscapeRoom\Models\Rate::class,

        'recurring_schedule' => \Tipoff\Scheduling\Models\RecurringSchedule::class,

        'refund' => \App\Models\Refund::class,

        'review' => \App\Models\Review::class,

        'room' => \Tipoff\EscapeRoom\Models\Room::class,

        'schedule' => \App\Models\Schedule::class,

        'schedule_eraser' => \Tipoff\Scheduling\Models\ScheduleEraser::class,

        'series' => \DrewRoberts\Blog\Models\Series::class,

        'signature' => \App\Models\Signature::class,

        'slot' => \Tipoff\Scheduling\Models\Slot::class,

        'snapshot' => \App\Models\Snapshot::class,

        'status' => \App\Models\Status::class,

        'supervision' => \Tipoff\EscapeRoom\Models\Supervision::class,

        'tag' => \DrewRoberts\Media\Models\Tag::class,

        'tax' => \Tipoff\Taxes\Models\Tax::class,

        'theme' => \Tipoff\EscapeRoom\Models\Theme::class,

        'topic' => \DrewRoberts\Blog\Models\Topic::class,

        'user' => \App\Models\User::class,

        'video' => \DrewRoberts\Media\Models\Video::class,

        'voucher' => \App\Models\Voucher::class,

        'voucher_type' => \App\Models\VoucherType::class,

    ]

];
