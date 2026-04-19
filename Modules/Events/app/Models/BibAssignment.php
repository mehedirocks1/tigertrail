<?php

namespace Modules\Events\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BibAssignment extends Model
{
    protected $table = 'bib_assignments';
    
    // guarded খালি রাখছি কারণ আমরা অনেকগুলো ডাটা একসাথে ইনসার্ট করবো
    protected $guarded = [];

    /**
     * আসল অ্যাটেন্ডি রেকর্ড (যদি কখনো অরিজিনাল ডাটা দেখার প্রয়োজন হয়)
     */
    public function attendee(): BelongsTo
    {
        return $this->belongsTo(Attendee::class, 'attendee_id');
    }

    /**
     * এই অ্যাসাইনমেন্টটি কোন ব্যাচের অংশ
     */
    public function bibManagement(): BelongsTo
    {
        return $this->belongsTo(BibManagement::class, 'bib_management_id');
    }
}