<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\Time_keep;
use App\Models\timeKeep;
use App\Models\User;
use DateTime;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CalendarService
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month_keep = date('m', strtotime($dateNow));

        $time_keep = timeKeep::create([
            'user_id' => $id,
            'time_in' => $dateNow,
            'day' => $day,
            'month' => $month_keep,
        ]);

        return $time_keep;
    }

    public function setTime($time_in, $time_out)
    {

        // lay ngay trung voi ngay contact
        $time_in_dt = new DateTime($time_in);
        $time_out_dt = new DateTime($time_out);

        $time13h = new DateTime();
        $time12h = new DateTime();
        $time9h = new DateTime();

        $time9h->setTime(9, 0, 0);
        $time13h->setTime(13, 0, 0);
        $time13h->setDate($time_in_dt->format('Y'), $time_in_dt->format('m'), $time_in_dt->format('d'));
        $time13h->format('Y-m-d H:i:s');
        $time12h->setTime(12, 0, 0);
        $time12h->setDate($time_in_dt->format('Y'), $time_in_dt->format('m'), $time_in_dt->format('d'));
        $time12h->format('Y-m-d H:i:s');
        if ($time_in_dt < $time9h && $time_out_dt > $time9h) {
            $diff = $time9h->diff($time_out_dt);
        } else {
            $diff = $time_in_dt->diff($time_out_dt);
        }
        $h = $diff->h;
        $i = $diff->i;
        $result = $h  + $i / 60;

        $work_time = round($result, 1);

        if ($time_in_dt <= $time12h &&  $time13h <= $time_out_dt) {
            $work_time -= 1;
        } elseif ($time_in_dt <= $time12h &&  $time12h <= $time_out_dt  &&  $time_out_dt <= $time13h) {

            $time = $time12h->diff($time_out_dt);
            $time_redundant = $time->h + ($time->i / 60);
            $work_time -= $time_redundant;

            if ($work_time > 3.2) {
                $work_time = 3.2;
            }
        } elseif ($time12h <= $time_in_dt &&  $time_in_dt <= $time13h && $time_out_dt >= $time13h) {

            $time = $time_in_dt->diff($time13h);
            $time_redundant = $time->h + ($time->i / 60);
            $work_time -= $time_redundant;
            if ($work_time > 4.8) {
                $work_time = 4.8;
            }
        }
        $work_time = round(($work_time / 8), 1);
        if ($work_time > 1) {
            $work_time = 1;
        }

        return $work_time;
    }
    public function update($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month = date('m', strtotime($dateNow));
        $dayCheck = $day;

        $time_keep = timeKeep::where('user_id', $id)
            ->where('day', $dayCheck)
            ->where('month', $month)
            ->first();
        $time_keep->time_out = $dateNow;
        $time_keep->save();

        $work_time = $this->setTime($time_keep->time_in, $time_keep->time_out);

        // $time_keep->work_time = $work_time;

        // $time_keep->save();

        return $time_keep;
    }

    public function updateRequest($id, $time_in, $time_out, $day, $month)
    {
        $time_keep = timeKeep::find($id)
            ->where('month', $month)
            ->where('day', $day)->first();
        $time_keep->time_in = $time_in;
        $time_keep->time_out = $time_out;
        $work_time = $this->setTime($time_keep->time_in, $time_keep->time_out);

        $time_keep->work_time = $work_time;
        $time_keep->save();
    }

    public function getByUserId($id)
    {
        return timeKeep::where('user_id', $id)
            ->get();
    }
    public function getByDay($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $day = date('d', strtotime($dateNow));
        $month_keep = date('m', strtotime($dateNow));
        return timeKeep::Where('user_id', $id)
            ->where('day', $day)
            ->where('month', $month_keep)
            ->first();
    }

    public function getWorkTime($id)
    {
        $dateNow = date('Y-m-d H:i:s');
        $month_keep = date('m', strtotime('-1 month', strtotime($dateNow)));
        $timeKeep = timeKeep::where('user_id', $id)
            ->where('month', $month_keep)
            ->sum('work_time');
        $timeContact = Contact::where('user_id', $id)
            ->where('month', $month_keep)
            ->sum('flag');
        return $timeKeep + $timeContact;
    }

    public function getNotWork($year, $month, $id)
    {

        $now = date('Y-m-d H:i:s');
        $lastDayOfMonth = date('t', strtotime("$year-$month-01"));

        $monthNow = date('m', strtotime($now));

        if ($month >= $monthNow) {
            $notWork = timeKeep::selectRaw("DATE ")

                ->from(DB::raw("
            (SELECT DATE_ADD(DATE('$year-$month-01'), INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY) AS date
            
            FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS a

            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS b

            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS c

            WHERE a.a + (10 * b.a) + (100 * c.a)  < $lastDayOfMonth
            ) AS dates"))

                ->leftJoin('timeKeep', function ($join) use ($id) {
                    $join->on(DB::raw('DATE(dates.date)'), '=', DB::raw('DATE(timeKeep.created_at)'))
                        ->where('timeKeep.user_id', $id);
                })
                ->where(DB::raw("DATE(dates.date)"), '>=', "$year-$month-01")
                ->where(DB::raw("DATE(dates.date)"), '<', DB::raw("DATE(NOW())"))
                ->whereNull('timeKeep.created_at')
                ->whereRaw("DAYOFWEEK(dates.date) NOT IN (1, 7)")
                ->get();

            return $notWork->pluck('date');
        }

        $notWork = timeKeep::selectRaw("DATE ")
            ->from(DB::raw("
            (SELECT DATE_ADD(DATE('$year-$month-01'), INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY) AS date
            FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
            CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3
                UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7
                UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
            WHERE a.a + (10 * b.a) + (100 * c.a) < $lastDayOfMonth
        ) AS dates"))
            ->leftJoin('timeKeep', function ($join) use ($id) {
                $join->on(DB::raw('DATE(dates.date)'), '=', DB::raw('DATE(timeKeep.created_at)'))
                    ->where('timeKeep.user_id', $id);
            })
            ->where(DB::raw("DATE(dates.date)"), '>=', "$year-$month-01")
            ->where(DB::raw("DATE(dates.date)"), '<=', DB::raw("LAST_DAY('$year-$month-01')"))
            ->whereNull('timeKeep.created_at')
            ->whereRaw("DAYOFWEEK(dates.date) NOT IN (1, 7)")
            ->get();

        return $notWork->pluck('date');
    }
}
