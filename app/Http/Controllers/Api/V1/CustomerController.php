<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Utils\Util;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredentialsMailable;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;

use App\Http\Traits\InvestmentTrait;

class CustomerController extends Controller
{

    use InvestmentTrait;


    public function index(){      
        

        return new CustomerCollection(Customer::where('status',1)->get());
        
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $customer = DB::transaction(function () use($request){

                //Se validan que los campos del cliente obligatorios no estén vacíos.
                $fields = $request->validate([
                    'name' => 'required|string',
                    'last_name' => 'required|string',
                    'phone' => 'required|numeric',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'department' => 'required|string',
                    'country' => 'required|string',
                    'document_number' => 'required|numeric|unique:customers',
                    'file_document' => 'required|file',
                    'email' => 'required|email|unique:users,email',
                    /*'id_rol' => 'required|numeric',*/
                    'registered_by' => 'required|numeric',
                ]);
                
                               
                //Se calcula la clasificación del cliente dependiendo del monto de la inversión.
                $customer_type = Util::validateCustomerLevel($request->amount);
              
                //Se genera una contraseña aleatoria.
                $password = Util::generatePassword();
                
                //Se genera un código personal único, a partir del correo del cliente.
                $personal_code = Util::generatePersonalCode($fields['email']);

                //Se crea el usuario
                $user = User::create([
                    'name' => $fields['name']." ".$fields['last_name'],
                    'email' => $fields['email'],
                    'password' => bcrypt($password),
                    'id_rol' => 2,
                    'personal_code' => $personal_code
                ]);
                
                $file_document=NULL;
                if($request->hasFile("file_document")){
                    $file=$request->file("file_document");
                    
                    $file_document = "documento_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/documentos_identidad/".$file_document);
                    copy($file, $ruta);
                }
              
                $work_certificate=NULL;
                if($request->hasFile("work_certificate")){
                    $file=$request->file("work_certificate");
                    
                    $work_certificate = "certificado_laboral_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/certificados_laborales/".$work_certificate);
                    copy($file, $ruta);
                }

                $account_certificate=NULL;
                if($request->hasFile("account_certificate")){
                    $file=$request->file("account_certificate");
                    
                    $account_certificate = "certificado_cuenta_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/certificados_cuenta/".$account_certificate);
                    copy($file, $ruta);
                }

                $letter_authorization_third=NULL;
                if($request->hasFile("letter_authorization_third")){
                    $file=$request->file("letter_authorization_third");
                    
                    $letter_authorization_third = "carta_autorizacion_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/certificados_cuenta/".$letter_authorization_third);
                    copy($file, $ruta);
                }

                $file_rut=NULL;
                if($request->hasFile("file_rut")){
                    $file=$request->file("file_rut");
                    
                    $file_rut = "rut_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/rut/".$file_rut);
                    copy($file, $ruta);
                }

                $rut_third=NULL;
                if($request->hasFile("rut_third")){
                    $file=$request->file("rut_third");
                    
                    $rut_third = "rut_".$fields["document_number"].".".$file->guessExtension();
                    $ruta = public_path("archivos/rut_terceros/".$rut_third);
                    copy($file, $ruta);
                }
            
                //Se crea el cliente.
                $customer = Customer::create([
                    'id_user' => $user->id,
                    'name' => $fields["name"],
                    'last_name' => $fields["last_name"],
                    'phone' => $fields["phone"],
                    'address' => $fields["address"],
                    'city' => $fields["city"],
                    'department' => $fields["department"],
                    'country' => $fields["country"],
                    'document_number' => $fields["document_number"],
                    'file_document' => $file_document,
                    'description_ind' => $request->description_ind,
                    'file_rut' => $file_rut,
                    'business' => $request->business,
                    'position_business' => $request->position_business,
                    'antique_bussiness' => $request->antique_bussiness,
                    'type_contract' => $request->type_contract,
                    'work_certificate' => $work_certificate,
                    'pension_fund' => $request->pension_fund,
                    'especification_other' => $request->especification_other,
                    'account_number' => $request->account_number,
                    'account_type' => $request->account_type,
                    'bank_name' => $request->bank_name,
                    'account_certificate' => $account_certificate,
                    'document_third' => $request->document_third,
                    'name_third' => $request->name_third,
                    'letter_authorization_third' => $letter_authorization_third,
                    'kinship_third' => $request->kinship_third,
                    'rut_third' => $rut_third,
                    'id_document_type' => $request->id_document_type,
                    'id_economic_activity' => $request->id_economic_activity,
                    'id_bank_account' => $request->id_bank_account,
                    'id_customer_type' => $customer_type,
                    'registered_by' => $fields["registered_by"],

                ]);
                
                //Se usa el Trait InvestmentTrait para guardar la información de la inversión
                $this->storeInvestment($request, $customer->id);

               
                $dataCustomer["email"] =  $fields['email'];
                $dataCustomer["title"] = "Te damos la bienvenida a VIP World Trading";
                $dataCustomer["code"] = $personal_code; 
                $dataCustomer["password"] = $password;
                
                //Se envían las credenciales del cliente al correo
                Util::sendCredentialsEmail($dataCustomer);
              
                
                return $customer;
            
        }, 3); 
        
        return Util::setResponseJson(201, 'Se ha registrado el cliente y la inversión de exitosamente.');
  
    }


    public function show($id)
    {
        return new CustomerResource(Customer::find($id));
    }

    
    public function edit($customer)
    {
        $customer = new CustomerResource(Customer::find($id_customer));
        return Util::setJSONResponseUniqueData($customer);
    
    }

   
    public function update(Request $request, Customer $customer)
    {
        //
    }

   
    public function destroy(Customer $customer)
    {
        //
    }

    
    public function getCustomers($param){
       
        return new CustomerCollection(Customer::searchCustomerByParams($param));

    }

    public function getCustomersbyCustomerType(Request $request){
       
        $fields = $request->validate([
            'param' => 'required|string',
            'id_customer_type' => 'required|numeric',

        ]);
        
        return new CustomerCollection(
            Customer::searchCustomerByParamsAndCustomerType($fields['param'], $fields['id_customer_type'])
        );

    }
}
