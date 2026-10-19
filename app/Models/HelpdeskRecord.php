<?php

namespace App\Models;

use Database\Factories\HelpdeskRecordFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['ticket_number', 'title', 'customer_name', 'email', 'phone', 'category', 'status', 'description', 'attachment_path', 'attachment_name'])]
class HelpdeskRecord extends Model
{
    /** @use HasFactory<HelpdeskRecordFactory> */
    use HasFactory;
}
