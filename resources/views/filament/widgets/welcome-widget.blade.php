@php
    $weather = $this->getWeatherData();
    $smsBalance = $this->getSmsBalance();
    $sysInfo = $this->getSystemInfo();
    $stats = $this->getStats();
    // Fetching transactions using your Attendee model logic
    $transactions = $this->getTransactions(); 
@endphp

<div style="grid-column: 1 / -1; width: 100%; margin-bottom: 2rem;">
    <div style="min-height: 480px; width: 100%; padding: 45px; color: white; font-family: ui-sans-serif, system-ui; background: linear-gradient(135deg, #4f46e5 0%, #1e1b4b 100%); position: relative; overflow: hidden; border-radius: 2.5rem; display: flex; flex-direction: column; justify-content: space-between; box-sizing: border-box;">
        
        <div style="position:absolute; top:-100px; right:-100px; width:600px; height:600px; background:radial-gradient(circle, rgba(99,102,241,0.25) 0%, rgba(99,102,241,0) 70%); pointer-events: none;"></div>

        <div style="display: flex; justify-content: space-between; align-items: flex-start; position: relative; z-index: 10;">
            <div style="display: flex; gap: 15px;">
                <div style="background: rgba(255,255,255,0.1); padding: 12px 20px; border-radius: 18px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 20px;">💬</span>
                    <div>
                        <p style="margin: 0; font-size: 10px; opacity: 0.6; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">SMS Balance</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 800;">৳ {{ $smsBalance }}</p>
                    </div>
                </div>

                <div style="background: rgba(255,255,255,0.1); padding: 12px 20px; border-radius: 18px; backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 20px;">{{ $weather ? (str_contains($weather['weather'][0]['main'], 'Rain') ? '🌧️' : '☀️') : '🌍' }}</span>
                    <div>
                        <p style="margin: 0; font-size: 10px; opacity: 0.6; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">{{ $weather['name'] ?? 'Weather' }}</p>
                        <p style="margin: 0; font-size: 16px; font-weight: 800;">{{ $weather ? round($weather['main']['temp']).'°C' : 'Loading...' }}</p>
                    </div>
                </div>
            </div>

            <div style="text-align: right; background: rgba(52, 211, 153, 0.15); padding: 10px 20px; border-radius: 14px; border: 1px solid rgba(52, 211, 153, 0.3); color: #34d399; font-weight: 900; font-size: 12px; letter-spacing: 1px;">
                ● SYSTEM ONLINE
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 10; margin-top: 20px;">
            <div>
                <h1 style="font-size: 68px; font-weight: 950; line-height: 1; margin: 0; letter-spacing: -4px;">
                    Welcome back,<br>
                    <span style="color: #c7d2fe;">{{ $this->getUser()->name ?? 'Mehedi' }}</span>
                </h1>
                
                <div style="display: flex; gap: 30px; margin-top: 30px;">
                    <div style="border-left: 4px solid #6366f1; padding-left: 15px;">
                        <p style="margin: 0; font-size: 12px; opacity: 0.6; text-transform: uppercase; font-weight: 700;">Total Events</p>
                        <p style="margin: 0; font-size: 32px; font-weight: 900;">{{ $stats['events'] }}</p>
                    </div>
                    <div style="border-left: 4px solid #ec4899; padding-left: 15px;">
                        <p style="margin: 0; font-size: 12px; opacity: 0.6; text-transform: uppercase; font-weight: 700;">Total Attendees</p>
                        <p style="margin: 0; font-size: 32px; font-weight: 900;">{{ $stats['attendees'] }}</p>
                    </div>
                </div>
            </div>

            <div x-data="{ time: '' }" x-init="time = new Date().toLocaleTimeString(); setInterval(() => time = new Date().toLocaleTimeString(), 1000)" style="text-align: right;">
                <h2 style="font-size: 110px; font-weight: 950; margin: 0; font-variant-numeric: tabular-nums; letter-spacing: -6px; line-height: 0.8;" x-text="time"></h2>
                <p style="opacity: 0.5; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 3px; margin-top: 15px;">{{ now()->format('l, d F Y') }}</p>
            </div>
        </div>

        <div style="display: flex; gap: 40px; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1); position: relative; z-index: 10;">
            @foreach([
                'Laravel' => 'v'.$sysInfo['laravel_version'],
                'PHP' => 'v'.$sysInfo['php_version'],
                'Database' => $sysInfo['db_status'],
                'Memory' => $sysInfo['memory_usage'],
            ] as $label => $value)
                <div>
                    <p style="margin: 0; font-size: 10px; opacity: 0.5; text-transform: uppercase; letter-spacing: 1px; font-weight: 700;">{{ $label }}</p>
                    <p style="margin: 0; font-size: 14px; font-weight: 800; color: {{ $label == 'Database' ? '#4ade80' : 'white' }}">{{ $value }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div style="margin-top: 24px; background: #1e1b4b; border-radius: 1.5rem; padding: 30px; color: white; border: 1px solid rgba(255,255,255,0.1); font-family: ui-sans-serif, system-ui;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 22px; font-weight: 900;">Recent Transactions</h3>
            
            <div style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; padding: 6px 14px; border-radius: 10px; font-size: 11px; font-weight: 900; letter-spacing: 1.5px; border: 1px solid rgba(245, 158, 11, 0.3);">
                ⚠️ SANDBOX MODE
            </div>
        </div>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; text-align: left; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); opacity: 0.6; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                        <th style="padding: 16px 10px; font-weight: 800;">Tran ID</th>
                        <th style="padding: 16px 10px; font-weight: 800;">Attendee</th>
                        <th style="padding: 16px 10px; font-weight: 800;">Date</th>
                        <th style="padding: 16px 10px; font-weight: 800;">Event</th>
                        <th style="padding: 16px 10px; font-weight: 800;">Fee</th>
                        <th style="padding: 16px 10px; font-weight: 800;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.2s;">
                            <td style="padding: 18px 10px; font-family: monospace; font-size: 13px; font-weight: bold; color: #c7d2fe;">
                                {{ $trx->transaction_id ?? 'N/A' }}
                            </td>
                            <td style="padding: 18px 10px; font-weight: 600;">
                                {{ $trx->first_name }} {{ $trx->last_name }}
                            </td>
                            <td style="padding: 18px 10px; opacity: 0.8; font-size: 13px;">
                                {{ $trx->created_at->format('d M Y, h:i A') }}
                            </td>
                            <td style="padding: 18px 10px; font-weight: 600; color: #a5b4fc; font-size: 13px;">
                                {{ $trx->event->title ?? 'Event #'.$trx->event_id }}
                            </td>
                            <td style="padding: 18px 10px; font-weight: 900; font-size: 15px;">
                                ৳ {{ number_format($trx->registration_fee, 2) }}
                            </td>
                            <td style="padding: 18px 10px;">
                                <span style="padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 900; letter-spacing: 0.5px;
                                    @if(strtoupper($trx->payment_status) === 'SUCCESS' || strtoupper($trx->payment_status) === 'VALIDATED') background: rgba(52, 211, 153, 0.15); color: #34d399;
                                    @elseif(strtoupper($trx->payment_status) === 'FAILED') background: rgba(239, 68, 68, 0.15); color: #f87171;
                                    @else background: rgba(251, 191, 36, 0.15); color: #fbbf24; @endif">
                                    {{ strtoupper($trx->payment_status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 40px; text-align: center; opacity: 0.5; font-weight: 600;">
                                No transactions found yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>