<?php

namespace App\Sitri\Models\Admin;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool   use_registration
 * @property double register_value
 * @property string type_month_payment
 * @property bool   use_monthly
 * @property double one_month_value
 * @property double three_month_value
 * @property double day_off_value
 * @property string date_paid
 * @property array  items
 * @property bool   use_shopping
 * @property double total_item
 */
class Payment extends Model
{
    const TYPE_MONTH_PAYMENT_ONE_MONTH = 'ONE_MONTH';

    const TYPE_MONTH_PAYMENT_THREE_MONTH = 'THREE_MONTH';

    const TYPE_MONTH_PAYMENT_DAY_OFF = 'DAY_OFF';

    protected $fillable = [
        'no_payment',
        'student_id',
        'use_registration',
        'register_value',
        'use_monthly',
        'type_month_payment',
        'one_month_month',
        'one_month_value',
        'three_month_month',
        'three_month_value',
        'day_off_month',
        'day_off_value',
        'date_paid',
        'note',
        'use_shopping',
        'items',
        'year'
    ];

    protected $appends = ['total', 'total_item', 'status_payment', 'months', 'text_month'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getTotalAttribute()
    {
        $value = 0;

        if ($this->use_registration) {
            $value += $this->register_value;
        }

        if ($this->use_monthly) {
            switch ($this->type_month_payment) {
                case self::TYPE_MONTH_PAYMENT_ONE_MONTH:
                    $value += $this->one_month_value;
                    break;
                case self::TYPE_MONTH_PAYMENT_THREE_MONTH:
                    $value += $this->three_month_value;
                    break;
                case self::TYPE_MONTH_PAYMENT_DAY_OFF:
                    $value += $this->day_off_value;
            }
        }

        if ($this->use_shopping) {
            $value += $this->total_item;
        }

        return $value;
    }

    public function setItemsAttribute($value)
    {
        $this->attributes['items'] = json_encode($value);
    }

    public function getItemsAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getTotalItemAttribute()
    {
        $value = 0;
        if (is_array($this->items)) {
            foreach ($this->items as $item) {
                $value += $item['value'] * $item['quantity'];
            }
        }

        return $value;
    }

    public function getTextMonthAttribute()
    {
        switch ($this->type_month_payment) {
            case self::TYPE_MONTH_PAYMENT_ONE_MONTH:
                return config('sitri.month')[$this->one_month_month];
            case self::TYPE_MONTH_PAYMENT_THREE_MONTH:
                $split = explode('-', $this->three_month_month);

                return config('sitri.month')[$split[0]] . ' - ' . config('sitri.month')[$split[1]];
            case self::TYPE_MONTH_PAYMENT_DAY_OFF:
                return config('sitri.month')[$this->day_off_month];
            default:
                return '';
        }
    }

    public function getMonthsAttribute()
    {
        switch ($this->type_month_payment) {
            case self::TYPE_MONTH_PAYMENT_ONE_MONTH:
                return [(int)$this->one_month_month];
            case self::TYPE_MONTH_PAYMENT_THREE_MONTH:
                return explode('-', $this->three_month_month);
            case self::TYPE_MONTH_PAYMENT_DAY_OFF:
                return [(int)$this->day_off_month];
            default:
                return [0];
        }
    }

    public function getStatusPaymentAttribute()
    {
        if ($this->date_paid === null) {
            return 'Unpaid';
        }

        return 'Paid! : ' . Carbon::parse($this->date_paid)->format('d/m/y');
    }

    public function isPaidRangeMonth($year, $month)
    {
        $months = [];
        foreach ($this->months as $key => $monthList) {
            $newYear = $year;
            if (0 !== $key && $this->months[$key - 1] > $this->months[$key]) {
                $newYear++;
            }

            $months[] = $newYear . '-' . $month;
        }

        return in_array($year . '-' . $month, $months);
    }
}
