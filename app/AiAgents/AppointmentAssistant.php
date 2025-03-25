<?php

namespace App\AiAgents;

use LarAgent\Agent;
use App\Models\Service;
use App\Models\Slot;
use App\Enums\SlotStatus;
use LarAgent\Attributes\Tool;
use Illuminate\Support\Facades\Log;

class AppointmentAssistant extends Agent
{
    protected $history = 'file';

    protected $provider = 'ollama';

    protected $tools = [];

    public function instructions()
    {
        $services = Service::active()->get();
        return view('AppointmentAssistant.instructions', ['services' => $services])->render();
    }

    public function prompt($message)
    {
        $currentDate = now()->format('Y-m-d');
        return view('AppointmentAssistant.prompt', [
            'message' => $message,
            'currentDate' => $currentDate
        ])
        ->render();
    }

    #[Tool(" Check availability for a specific service and date to find available slots and slotId.")]
    public static function checkAvailability(int $serviceId, string $date) {
        $service = Service::find($serviceId);
        if (!$service) {
            return "Service not found";
        }
        $slots = Slot::where('service_id', $serviceId)
            ->where('day', \Carbon\Carbon::parse($date))
            ->where('status', SlotStatus::Available)
            ->get();
            
        if ($slots) {
            return view('AppointmentAssistant.checkAvailability', [
                'service' => $service,
                'date' => $date,
                'slots' => $slots
            ])->render();
        } else {
            return "No available slots for " . $service->name . " at " . $date;
        }
    }

    #[Tool("Book an appointment for a specific service, date and slotId after you have confirmed name and email with user.")]
    public static function bookAppointment(int $slotId, string $name, string $email, string $date) {
        $slot = Slot::find($slotId);
        if (!$slot) {
            return "Slot is not found, try again with correct slot ID";
        }
        if ($slot->status !== SlotStatus::Available) {
            return "Slot is not available, check availability again";
        }
        $slot->status = SlotStatus::Booked;
        $slot->customer_name = $name;
        $slot->customer_email = $email;
        $slot->save();
        return "Appointment booked successfully";
    }

    #[Tool("Transfer the conversation to a manager. This is a fallback tool. Use only when asked to contact human")]
    public static function transferToManager(string $name, string $email, string $comment_or_extra_info) {
        // Log for testing purposes, you can send email to a manager with this info
        Log::info("Transfer to manager: " . $name . " - " . $email . " - " . $comment_or_extra_info);
        return "Here is the contact info of manager: Angelina (+55 19 9884 88 4155)";
    }
}
