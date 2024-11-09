<?php

namespace Rhodiz\Config\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\Customer\Repositories\CustomerRepository;
use Webkul\Sales\Repositories\OrderRepository;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Customer\Repositories\CustomerNoteRepository;
use Webkul\Core\Repositories\SubscribersListRepository;
use Webkul\Customer\Models\Customer;
use Webkul\Customer\Models\CustomerNote;
use Webkul\Sales\Repositories\OrderCommentRepository;
use Webkul\Sales\Models\Refund;
use Webkul\Sales\Models\Shipment;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Models\Invoice;

use Illuminate\Support\Facades\App;

class ConfigController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(protected ProductRepository $productRepository,
           protected CustomerRepository $customerRepository,
           protected OrderRepository $orderRepository,
           protected CustomerNoteRepository $customerNoteRepository,
           protected SubscribersListRepository $subscribersListRepository,
           protected OrderCommentRepository $orderCommentRepository,
           protected InvoiceRepository $invoiceRepository
           )
    {}

    public function index()
    {
        // Definir los tipos de correos
        $emails = [
            'customers.commented',
            'customers.email-verification',
            'customers.forgot-password',
            'customers.new-customer',
            'customers.registration',
            'customers.subscribed',
            'customers.update-password',
            'orders.canceled',
            'orders.commented',
            'orders.created',
            'orders.invoiced',
            'orders.refunded',
            'orders.shipped',
            'contact-us',

            'admin.admin.forget-password',
            'admin.customers.new-customer',
            'admin.orders.canceled',
            'admin.orders.created',
            'admin.orders.inventory-source',
            'admin.orders.invoiced',
            'admin.orders.refunded',
            'admin.orders.shipped'
        ];

        // Retornar la vista con el listado de correos
        return view('rhodiz_config::emails.index', compact('emails'));
    }

    public function preview()
    {
        $params = request()->input();

        $mailType = $params['type'] ?? '';

        $locale = $params['lang'] ?? 'en';

        // En tu controlador
        App::setLocale($locale); // Cambia 'es' por el código de idioma deseado

        switch ($mailType) {
            case 'customers.commented':
                $customerNote = CustomerNote::latest()->first();
                return view('shop::emails.customers.commented', compact('customerNote'));
                break;

            case 'customers.email-verification':
                $customer = Customer::latest()->first();
                $token = "xxxx-xxxxx-xxxxxxxxxx";
                return view('shop::emails.customers.email-verification', compact('userName','token'));
                break;

            case 'customers.forgot-password':
                $userName = "Reinaldo Lorenzo";
                $token = "xxxx-xxxxx-xxxxxxxxxx";
                return view('shop::emails.customers.forgot-password', compact('userName','token'));
                break;

            case 'customers.new-customer':
                $password = "xxxx-xxxxxxxxx";
                $customer = Customer::latest()->first();
                return view('shop::emails.customers.new-customer', compact('customer','password'));
                break;

            case 'customers.registration':
                $customer = Customer::latest()->first();
                return view('shop::emails.customers.registration', compact('customer'));
                break;

            case 'customers.subscribed':
                $fullName = "Reinaldo Lorenzo";
                $subscribersList = $this->subscribersListRepository->latest()->first();
                return view('shop::emails.customers.subscribed', compact('subscribersList'));
                break;

            case 'customers.update-password':
                $customer = Customer::latest()->first();
                return view( 'shop::emails.customers.update-password', compact('customer'));
                break;

            case 'orders.canceled':
                $order = Order::latest()->first();
                return view('shop::emails.orders.canceled', compact('order'));
                break;

            case 'orders.commented':
                $comment = $this->orderCommentRepository->latest()->first();
                return view('shop::emails.orders.commented', compact('comment'));
                break;

            case 'orders.created':
                $order = Order::latest()->first();
                return view('shop::emails.orders.created', compact('order'));
                break;

            case 'orders.invoiced':
                $invoice = Invoice::latest()->first();
                return view('shop::emails.orders.invoiced', compact('invoice'));
                break;

            case 'orders.refunded':
                $refund = Refund::latest()->first();
                return view('shop::emails.orders.refunded', compact('refund'));
                break;

            case 'orders.shipped':
                $shipment = Shipment::latest()->first();
                return view('shop::emails.orders.shipped', compact('shipment'));
                break;

            case 'contact-us':
                $contactUs = [
                    "email" => "example@gmail.com",
                    "message" => "Este es un mensaje",
                    "contact" => "+1-258-258-2587",
                ];
                return view('shop::emails.contact-us', compact('contactUs'));
                break;

            case 'admin.admin.forget-password':
                $userName = "Reinaldo Lorenzo";
                $token = "xxxx-xxxxx-xxxxxxxxxx";
                return view('admin::emails.admin.forget-password', compact('userName','token'));
                break;

            case 'admin.customers.new-customer':
                $customer = Customer::latest()->first();
                return view('admin::emails.customers.registration', compact('customer'));
                break;

            case 'admin.orders.canceled':
                $order = Order::latest()->first();
                return view('admin::emails.orders.canceled', compact('order'));
                break;
            case 'admin.orders.created':
                $order = Order::latest()->first();
                return view('admin::emails.orders.created', compact('order'));
                break;

            case 'admin.orders.invoiced':
                $invoice = Invoice::latest()->first();
                return view('admin::emails.orders.invoiced', compact('invoice'));
                break;

            case 'admin.orders.refunded':
                $refund = Refund::latest()->first();
                return view('admin::emails.orders.refunded', compact('refund'));
                break;

            case 'admin.orders.shipped':
                $shipment = Shipment::latest()->first();
                return view('admin::emails.orders.shipped', compact('shipment'));
                break;

            case 'admin.orders.inventory-source':
                $shipment = Shipment::latest()->first();
                return view('admin::emails.orders.inventory-source', compact('shipment'));
                break;

            default:
                // Lógica para cualquier caso no contemplado
                echo "Mail no reconocido";
                break;
        }
    }
}
