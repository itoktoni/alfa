<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\Finance\Dao\Models\Payment;
use Modules\Sales\Emails\CreateOrderEmail;
use Modules\Sales\Emails\TestingOrderEmail;
use Modules\Sales\Emails\CreateLanggananEmail;
use Modules\Finance\Emails\ApprovePaymentEmail;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Modules\Finance\Emails\ConfirmationPaymentEmail;
use Modules\Finance\Dao\Repositories\PaymentRepository;
use Modules\Sales\Dao\Repositories\SubscribeRepository;
use Modules\Procurement\Dao\Repositories\PurchasePrepareRepository;
use Modules\Procurement\Emails\CreateOrderEmail as EmailsCreateOrderEmail;

class SendEmail extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To Sending Email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order = new OrderRepository();
        $order_data = $order->dataRepository()->whereNull('sales_order_date_quotation')->limit(2)->get();
        if ($order_data) {

            foreach ($order_data as $order_item) {

                $data = $order->showRepository($order_item->sales_order_id, ['detail', 'company']);
                Mail::to([config('website.email')])->send(new CreateOrderEmail($data));
                $data->sales_order_date_quotation = date('Y-m-d H:i:s');
                $data->save();
            }
        }
        
        $langganan = new SubscribeRepository();
        $langganan_data = $langganan->dataRepository()->whereNull('sales_langganan_date_email')->limit(1)->get();
        
        if ($langganan_data) {
            foreach ($langganan_data as $langganan_item) {
                $data = $langganan->showRepository($langganan_item->sales_langganan_id);
                Mail::to([config('website.email')])->send(new CreateLanggananEmail($data));
                $data->sales_langganan_date_email = date('Y-m-d H:i:s');
                $data->save();
            }
        }

        // $payment = new PaymentRepository();
        // $payment_data = $payment->dataRepository()->whereNull('finance_payment_reference')->whereNull('finance_payment_email_date')->limit(1)->get();
        // if ($payment_data) {

        //     foreach ($payment_data as $payment_item) {
        //         $data = $payment->showRepository($payment_item->finance_payment_id);
        //         Mail::to([$payment_item->finance_payment_email, config('website.email')])->send(new ConfirmationPaymentEmail($data));
        //         $data->finance_payment_email_date = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        // $payment_approve = $payment->dataRepository()->whereNull('finance_payment_reference')->whereNull('finance_payment_email_approve_date')->whereNotNull('finance_payment_approved_at')->limit(1)->get();
        // if ($payment_approve) {

        //     foreach ($payment_approve as $payment_aprove) {
        //         $data = $payment->showRepository($payment_aprove->finance_payment_id);
        //         Mail::to([$payment_item->finance_payment_email, config('website.email')])->send(new ApprovePaymentEmail($data));
        //         $data->finance_payment_email_approve_date = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        // $prepare_order = new PurchasePrepareRepository();
        // $prepare_order_data = $prepare_order->dataRepository()->where('purchase_status', 3)->whereNull('purchase_sent_date')->limit(1)->get();
        // if ($prepare_order_data) {

        //     foreach ($prepare_order_data as $prepare_order_item) {

        //         $data = $prepare_order->showRepository($prepare_order_item->purchase_id, ['vendor','detail', 'detail.product']);
        //         Mail::to([$data->vendor->procurement_vendor_email, config('website.warehouse')])->send(new EmailsCreateOrderEmail($data));
        //         $data->purchase_sent_date = date('Y-m-d H:i:s');
        //         $data->save();
        //     }
        // }

        $this->info('The system has been sent successfully!');
    }
}
