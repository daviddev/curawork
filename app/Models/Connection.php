<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    /**
     * @traot HasFactory.
     */
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var string[]|bool
     */
    protected $guarded = ['id'];

    /**
     * @var string
     */
    public const STATUS_PENDING = 'pending';

    /**
     * @var string
     */
    public const STATUS_ACCEPTED = 'accepted';

    /**
     * @var string
     */
    public const STATUS_DECLINED = 'declined';

    /**
     * @var string
     */
    public const TYPE_SUGGESTIONS = 'suggestions';

    /**
     * @var string
     */
    public const TYPE_SENT_REQUESTS = 'sent_requests';

    /**
     * @var string
     */
    public const TYPE_RECEIVED_REQUESTS = 'received_requests';

    /**
     * @var string
     */
    public const TYPE_CONNECTIONS = 'connections';
}
