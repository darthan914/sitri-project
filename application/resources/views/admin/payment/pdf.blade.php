<style type="text/css">
    .tg {
        font-family: "Comic Sans MS", cursive, sans-serif !important;
        border-collapse: collapse;
        border-spacing: 0;
        border: none;
    }

    .tg td {
        font-size: 8px;
        overflow: hidden;
        word-break: normal;
        padding: 2px;
    }

    .tg th {
        font-size: 8px;
        font-weight: normal;
        overflow: hidden;
        word-break: normal;
    }

    .tg .tg-0ypy {
        text-align: center;
        vertical-align: middle;
        font-weight: bold;
        font-size: 11px;
    }

    .tg .tg-ln06 {
        font-weight: bold;
        font-size: 15px;
        text-align: left;
        vertical-align: middle
    }

    .tg .tg-w4gq {
        text-align: center;
        vertical-align: top
    }

    .tg .tg-7gxf {
        text-align: right;
        vertical-align: middle
    }

    .tg .tg-1ydk {
        text-align: left;
        vertical-align: middle
    }

    .tg .tg-vfh4 {
        text-align: left;
        vertical-align: top
    }

    .tg .tg-kf9x {
        font-size: 28px;
        text-align: center;
        vertical-align: top
    }

    .full-box {
        border: solid thin black;
    }

    .box-part-left {
        border-left: solid thin black;
        border-top: solid thin black;
        border-bottom: solid thin black;
    }

    .box-part-middle {
        border-top: solid thin black;
        border-bottom: solid thin black;
    }

    .box-part-right {
        border-right: solid thin black;
        border-top: solid thin black;
        border-bottom: solid thin black;
    }
</style>

<table class="tg" style="table-layout: fixed; width: 100%">
    <tr>
        <td style="width: 25%"></td>
        <td style="width: 4%"></td>
        <td style="width: 14%"></td>
        <td style="width: 2%"></td>
        <td style="width: 38%"></td>
        <td style="width: 3%"></td>
        <td style="width: 14%"></td>
    </tr>
    <tr>
        <th class="tg-1ydk"></th>
        <th class="tg-ln06" colspan="4">KWITANSI</th>
        <th class="tg-1ydk">No:</th>
        <th class="tg-0ypy full-box">{{ $payment['no_payment'] }}</th>
    </tr>

    <tr>
        <td colspan="7"></td>
    </tr>

    <tr>
        <td class="tg-0ypy" rowspan="8"><img src="{{ asset('admin/kdc-logo.jpg') }}" width="76%"></td>
        <td class="tg-1ydk" colspan="2">Nama</td>
        <td class="tg-0ypy">:</td>
        <td class="tg-1ydk full-box" colspan="3">{{ $payment['student']['name'] }}</td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-1ydk" colspan="6">Pembayaran</td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-1ydk full-box" style="text-align: center">@if($payment['use_registration']) V @endif</td>
        <td class="tg-1ydk">Pendaftaran</td>
        <td class="tg-0ypy">:</td>
        <td class="tg-1ydk box-part-left"></td>
        <td class="tg-1ydk box-part-middle">Rp.</td>
        <td class="tg-7gxf box-part-right">
            @if($payment['use_registration'])
                {{ number_format($payment['register_value']) }}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-1ydk full-box" style="text-align: center">@if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_DAY_OFF !== $payment['type_month_payment'])
                V @endif</td>
        <td class="tg-1ydk">Uang Les Bulan</td>
        <td class="tg-0ypy">:</td>
        <td class="tg-1ydk box-part-left">
            @if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_DAY_OFF !== $payment['type_month_payment'])
                {{ $payment['text_month'] }}
            @endif
        </td>
        <td class="tg-1ydk box-part-middle">Rp.</td>
        <td class="tg-7gxf box-part-right">
            @if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_ONE_MONTH === $payment['type_month_payment'])
                {{ number_format($payment['one_month_value']) }}
            @elseif($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_THREE_MONTH === $payment['type_month_payment'])
                {{ number_format($payment['three_month_value']) }}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-0ypy" rowspan="8" nowrap style="font-size: 9px">Sanggar Lukis Anak<br>Jl. Gelong Baru Timur 3/3<br>Tomang - Jakarta Barat<br>Telp.
            08551140101<br>IG: KIDSDRAWINGCLASS<br>www.kidsdrawingclass.blogspot.com
        </td>
        <td class="tg-1ydk full-box" style="text-align: center">
            @if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_DAY_OFF === $payment['type_month_payment'])
                V
            @endif
        </td>
        <td class="tg-1ydk">Cuti Bulan</td>
        <td class="tg-0ypy">:</td>
        <td class="tg-1ydk box-part-left">
            @if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_DAY_OFF === $payment['type_month_payment'])
                {{ $payment['text_month'] }}
            @endif
        </td>
        <td class="tg-1ydk box-part-middle">Rp.</td>
        <td class="tg-7gxf box-part-right">
            @if($payment['use_monthly'] && \App\Sitri\Models\Admin\Payment::TYPE_MONTH_PAYMENT_DAY_OFF === $payment['type_month_payment'])
                {{ number_format($payment['day_off_value']) }}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-1ydk full-box" style="text-align: center">
            @if($payment['use_shopping'])
                V
            @endif
        </td>
        <td class="tg-1ydk">Belanja</td>
        <td class="tg-0ypy">:</td>
        <td class="tg-1ydk box-part-left"></td>
        <td class="tg-1ydk box-part-middle">Rp.</td>
        <td class="tg-7gxf box-part-right">
            @if($payment['use_shopping'])
                {{ number_format($payment['total_item']) }}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-vfh4" colspan="2">Sebesar</td>
        <td class="tg-w4gq">:</td>
        <td class="tg-vfh4 full-box" colspan="3">Rp. {{ number_format($payment['total']) }}</td>
    </tr>

    <tr>
        <td colspan="6"></td>
    </tr>

    <tr>
        <td class="tg-vfh4" colspan="2">Diterima tgl</td>
        <td class="tg-w4gq">:</td>
        <td class="tg-vfh4 full-box" colspan="3">
            @if(null !== $payment['date_paid'])
                {{ \Carbon\Carbon::parse($payment['date_paid'])->format('d/m/Y') }}
            @endif
        </td>
    </tr>

    <tr>
        <td colspan="7"></td>
    </tr>

    <tr>
        <td class="tg-vfh4" colspan="5">*note: kwitansi harap disimpan sebagai bukti bayar jika diperlukan</td>
        <td class="tg-kf9x full-box" colspan="2">@if(null !== $payment['date_paid']) LUNAS @endif</td>
    </tr>
</table>

