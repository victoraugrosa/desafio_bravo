<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Resources\ResponseCreatedResource;
use App\Http\Resources\ResponseErrorsResource;
use App\Http\Resources\ResponseOkResource;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**  
     * @OA\Schema(
     *   schema="CurrencyResource",
     *   description="Response model of data currency",
     *   @OA\Property(
     *       property="id",
     *       type="integer"
     *   ),
     *   @OA\Property(
     *       property="initials",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="description",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="money_backing",
     *       type="number",
     *       format="double",
     *       example=0.01
     *   ),
     *   @OA\Property(
     *       property="created_at",
     *       type="string",
     *       example="2021-06-12 13:43:43"
     *   ),
     *   @OA\Property(
     *       property="updated_at",
     *       type="string",
     *       example="2021-06-12 13:43:43"
     *   ),
     *  
     *),
     *
     * @OA\Schema(
     *   schema="CurrencyPostBody",
     *   description="Body model of data currency",
     *   @OA\Property(
     *       property="initials",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="description",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="money_backing",
     *       type="number",
     *       format="double",
     *       example=0.01
     *   ),
     *  
     *),
     * @OA\Schema(
     *   schema="CurrencyAmount",
     *   description="Body model of data currency converted",
     *   @OA\Property(
     *       property="currencyFrom",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="currencyTo",
     *       type="string"
     *   ),
     *   @OA\Property(
     *       property="amountConverted",
     *       type="number",
     *       format="double",
     *       example=0.01
     *   ),
     *  
     *),
     *  @OA\Schema(
     *   schema="success",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="success",
     *       type="boolean",
     *       example=true
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="successFalse",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="success",
     *       type="boolean",
     *       example=false
     *   ),
     *),
     *  @OA\Schema(
     *   schema="uuid",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="uuid",
     *       type="string",
     *       example="216e2374-a999-4dda-a390-6ec1e2b622e4"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="messageOk",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="message",
     *       type="string",
     *       example="OK"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="messageError",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="message",
     *       type="string",
     *       example="Error"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="messageCreated",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="message",
     *       type="string",
     *       example="Created"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="statusOk",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="status",
     *       type="integer",
     *       example="200"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="statusCreated",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="status",
     *       type="integer",
     *       example="201"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="dataArray",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="data",
     *       type="array",
     *       @OA\Items(
     *          type="object",
     *          ref="#/components/schemas/CurrencyResource"
     *       )
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="data",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CurrencyResource"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="dataAmount",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="data",
     *       type="object",
     *       ref="#/components/schemas/CurrencyAmount"
     *   ),
     *),
     *
     *  @OA\Schema(
     *   schema="errors",
     *   description="Part of the requisition model",
     *   @OA\Property(
     *       property="errors",
     *       type="array",
     *       @OA\Items(
     *          type="string",
     *          example="Id field is required!"
     *       )
     *   ),
     *),
     * 
     * @OA\Schema(
     *   schema="ResponseOk",
     *   description="Request model to update attachment data.",
     *   allOf={
     *          @OA\Schema(ref="#/components/schemas/success"),
     *          @OA\Schema(ref="#/components/schemas/dataArray"),
     *          @OA\Schema(ref="#/components/schemas/statusOk"),
     *          @OA\Schema(ref="#/components/schemas/messageOk"),
     *          @OA\Schema(ref="#/components/schemas/uuid"),
     *   }  
     * ),
     * 
     * @OA\Schema(
     *   schema="ResponseOkAmount",
     *   description="Request model to update attachment data.",
     *   allOf={
     *          @OA\Schema(ref="#/components/schemas/success"),
     *          @OA\Schema(ref="#/components/schemas/dataAmount"),
     *          @OA\Schema(ref="#/components/schemas/statusOk"),
     *          @OA\Schema(ref="#/components/schemas/messageOk"),
     *          @OA\Schema(ref="#/components/schemas/uuid"),
     *   }  
     * ),
     * 
     * @OA\Schema(
     *   schema="ResponseOkData",
     *   description="Request model to update attachment data.",
     *   allOf={
     *          @OA\Schema(ref="#/components/schemas/success"),
     *          @OA\Schema(ref="#/components/schemas/data"),
     *          @OA\Schema(ref="#/components/schemas/statusOk"),
     *          @OA\Schema(ref="#/components/schemas/messageOk"),
     *          @OA\Schema(ref="#/components/schemas/uuid"),
     *   }  
     * ),
     *      
     * @OA\Schema(
     *   schema="ResponseError",
     *   description="Request model to update attachment data.",
     *   allOf={
     *          @OA\Schema(ref="#/components/schemas/successFalse"),
     *          @OA\Schema(ref="#/components/schemas/errors"),
     *          @OA\Schema(ref="#/components/schemas/messageError"),
     *   }  
     * ),
     * 
     * @OA\Schema(
     *   schema="ResponseCreated",
     *   description="Request model to update attachment data.",
     *   allOf={
     *          @OA\Schema(ref="#/components/schemas/success"),
     *          @OA\Schema(ref="#/components/schemas/data"),
     *          @OA\Schema(ref="#/components/schemas/statusCreated"),
     *          @OA\Schema(ref="#/components/schemas/messageCreated"),
     *          @OA\Schema(ref="#/components/schemas/uuid"),
     *   }  
     * )
     * 
     * @OA\Get(
     *      tags={"currency"},
     *      summary="Returns currencies.",
     *      description="Returns all currencies.",
     *      path="/currency/",
     * 
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currencies.",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ResponseOk"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
    */
    public function getAllCurrencies(Request $request)
    {   
        $currencies = Currency::all();

        return response()->json(new ResponseOkResource($currencies), 200);
    }

    /**
     * @OA\Get(
     *      tags={"currency"},
     *      summary="Returns currency by id.",
     *      description="Returns currency data.",
     *      path="/currency/{id}",
     * 
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(
     *              type="integer",
     *         ),
     *         description="Defines currency id.",
     *         required=true,
     *       ),
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currencies.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseOkData"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
     * 
     * 
     */

    public function getCurrencyById(Request $request)
    { 
        $errors = self::verifyErrors($request);

        if(!empty($errors))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource($errors), 422));
            
        $currency = Currency::find($request->id);

        return response()->json(new ResponseOkResource($currency), 200);
    }
     /**
     * @OA\Patch(
     *      tags={"currency"},
     *      summary="Returns currency by id.",
     *      description="Returns currency data.",
     *      path="/currency/{id}",
     * 
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(
     *              type="integer",
     *         ),
     *         description="Defines currency id.",
     *         required=true,
     *       ),
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currencies.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseOkData"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
     * 
     * 
     */
    public function updateItemsCurrency(Request $request)
    {
        $errors = self::verifyErrors($request);

        if(!empty($errors))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource($errors), 422));

        $data = array(
            'initials'      => $request->initials,
            'description'   => $request->description,
            'money_backing' => $request->money_backing,

        );

        $currency = Currency::updateCurrency($request->id, $data);

        return response()->json(new ResponseOkResource($currency), 200);
    }
    /**
     * @OA\Put(
     *      tags={"currency"},
     *      summary="Returns currency by id.",
     *      description="Returns currency data.",
     *      path="/currency/{id}",
     * 
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         @OA\Schema(
     *              type="integer",
     *         ),
     *         description="Defines currency id.",
     *         required=true,
     *       ),
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currencies.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseOkData"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
     * 
     * 
     */

    public function updateAllItemsCurrency(Request $request)
    {
        $errors = self::verifyErrors($request);
        
        if(!empty($errors))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource($errors), 422));

        $data = array(
            'initials'      => $request->initials,
            'description'   => $request->description,
            'money_backing' => $request->money_backing,

        );

        $currency = Currency::updateCurrency($request->id, $data);

        return response()->json(new ResponseOkResource($currency), 200);
    }

    /**
     * @OA\Post(
     *      tags={"currency"},
     *      summary="Returns currency by id.",
     *      description="Returns currency data.",
     *      path="/currency/",
     * 
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              ref="#/components/schemas/CurrencyPostBody"
     *          ),
     *     ), 
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currencies.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseCreated"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
     * 
     * 
     */
    public function newCurrency(Request $request)
    {
        $errors = self::verifyErrors($request);

        if(!empty($errors))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource($errors), 422));

        $data = array(
            'initials'      => $request->initials,
            'description'   => $request->description,
            'money_backing' => $request->money_backing,

        );

        $currency = Currency::createCurrency($data);

        return response()->json(new ResponseCreatedResource($currency), 201);
    }

    /**
     * @OA\Get(
     *      tags={"currency"},
     *      summary="Returns currency by id.",
     *      description="Returns currency data.",
     *      path="/currency",
     * 
     *      @OA\Parameter(
     *         name="from",
     *         in="query",
     *         @OA\Schema(
     *              type="string",
     *         ),
     *         description="Defines currency",
     *         required=true,
     *       ),
     *      @OA\Parameter(
     *         name="to",
     *         in="query",
     *         @OA\Schema(
     *              type="string",
     *         ),
     *         description="Defines currency to be converted",
     *         required=true,
     *       ),
     *      @OA\Parameter(
     *         name="amount",
     *         in="query",
     *         @OA\Schema(
     *              type="number",
     *              format="double",
     *              example=0.01
     *         ),
     *         description="Defines values to currency from",
     *         required=true,
     *       ),
     *       @OA\Response(
     *          response="200",
     *          description="Get data of currency converted.",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ResponseOkAmount"
     *          ),
     *      ),
     *      @OA\Response(
     *          response="422", 
     *          description="Bad Request. Problem usually happens when request required specifc field was not entered.",
     *          @OA\JsonContent(
     *               ref="#/components/schemas/ResponseError"
     *          ),
     *      ),
     *),
     * 
     * 
     */

    public function converterCurrency(Request $request)
    {
        $errors = self::verifyErrors($request);

        if(!empty($errors))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource($errors), 422));

        $from   = Currency::getCurrencyByInitials($request->from);

        $to     = Currency::getCurrencyByInitials($request->to);

        if(is_null($from) || is_null($to))
            throw new HttpResponseException(response()->json(new ResponseErrorsResource(["Currency data not found or not exist!"]), 422));

        $amount = $request->amount;

        $result = ($from / $to) * $amount;

        $result = number_format($result, 8, '.','');

        $response = array(
            'currencyFrom'      => $request->from,
            "currencyTo"        => $request->to,
            "amountConverted"   => $result
        );
  
        return response()->json(new ResponseOkResource($response), 200);
    }

    public static function verifyErrors($request)
    {
        $errors = array();
        switch($request->method()){
            case "GET":
                if(isset($request->id)){
                    if(!isset($request->id))
                        array_push($errors,"Id is required!");
                        
                    if(!is_numeric($request->id))
                        array_push($errors,"Id must be integer!");
                }else{
                    if(!isset($request->to) || !isset($request->from))
                        array_push($errors,"Two fields are required: 'from' and 'to'!");
                    
                    if(is_numeric($request->from) || is_numeric($request->to))
                        array_push($errors,"The fields 'from' and 'to' must be a string");
                }

                break;
            
            case "POST":
                if(gettype($request->initials) != "string")
                    array_push($errors,"Initials must be string!");

                if(gettype($request->description)!= "string")
                    array_push($errors,"Description must be string!");

                if(!is_numeric($request->money_backing))
                    array_push($errors,"The field money_backing must be a float number!");

                break;

            case "PATCH":
                if(!is_numeric($request->id))
                    array_push($errors,"Id must be integer!");

                if(isset($request->initials) && gettype($request->initials) != "string")
                    array_push($errors,"Initials must be string!");

                if(isset($request->description) && gettype($request->description)!= "string")
                    array_push($errors,"Description must be string!");

                if(isset($request->money_backing) && !is_numeric($request->money_backing))
                    array_push($errors,"The field money_backing must be a float number!");
                break;
            
            default:
                if(!is_numeric($request->id))
                    array_push($errors,"Id must be integer!");

                if(gettype($request->initials) != "string")
                    array_push($errors,"Initials must be string!");

                if(gettype($request->description)!= "string")
                    array_push($errors,"Description must be string!");

                if(!is_numeric($request->money_backing))
                    array_push($errors,"The field money_backing must be a float number!");

                break;
            
        }
        return $errors;
    }

}
