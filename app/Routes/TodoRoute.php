<?php

namespace App\Routes;


/**
 * @OA\Get(
 *     path="/api/todos",
 *     summary="Retorna uma lista de tarefas",
 *     description="Retorna todas as tarefas cadastradas no banco de dados.",
 *     @OA\Response(
 *         response=200,
 *         description="Operação bem-sucedida",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="title", type="string", example="title teste"),
 *                 @OA\Property(property="description", type="string", example="description teste"),
 *                 @OA\Property(property="completed", type="boolean", example=0)
 *             )
 *         )
 *     ),
 *     tags={"Todos"}
 * )
 *
 * @OA\Get(
 *      path="/api/todos/{id}",
 *      summary="Obtém detalhes de uma tarefa específica pelo ID",
 *      description="Retorna os detalhes de uma única tarefa, incluindo título, descrição e status de conclusão, pelo ID.",
 *      operationId="getTodoById",
 *      tags={"Todos"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="ID da tarefa a ser obtida",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Operação bem-sucedida",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer", example=5),
 *              @OA\Property(property="title", type="string", example="title teste"),
 *              @OA\Property(property="description", type="string", example="description teste"),
 *              @OA\Property(property="completed", type="integer", example=0)
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not Found - A tarefa com o ID fornecido não foi encontrada."
 *      )
 *  )
 *
 * @OA\Post(
 *      path="/api/todos",
 *      summary="Adiciona uma nova tarefa",
 *      description="Cria uma nova tarefa e retorna a tarefa criada.",
 *      operationId="addTodo",
 *      tags={"Todos"},
 *      @OA\RequestBody(
 *          description="Dados da nova tarefa",
 *          required=true,
 *          @OA\JsonContent(
 *              required={"title","description"},
 *              @OA\Property(property="title", type="string", example="title teste"),
 *              @OA\Property(property="description", type="string", example="description teste")
 *          )
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Tarefa criada com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer", example=19),
 *              @OA\Property(property="title", type="string", example="title teste"),
 *              @OA\Property(property="description", type="string", example="description teste"),
 *              @OA\Property(property="completed", type="boolean", example=false)
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Dados inválidos"
 *      )
 *  )
 *
 * @OA\Put(
 *      path="/api/todos/{id}",
 *      summary="Atualiza uma tarefa específica",
 *      description="Atualiza uma tarefa pelo seu ID e retorna a tarefa atualizada.",
 *      tags={"Todos"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID da tarefa a ser atualizada",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          description="Dados da tarefa a ser atualizada",
 *          @OA\JsonContent(
 *              required={"title","description"},
 *              @OA\Property(property="title", type="string", example="title teste editado"),
 *              @OA\Property(property="description", type="string", example="description teste editado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Tarefa atualizada com sucesso",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer", example=17),
 *              @OA\Property(property="title", type="string", example="title teste editado"),
 *              @OA\Property(property="description", type="string", example="description teste editado"),
 *              @OA\Property(property="completed", type="boolean", example=false)
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Tarefa não encontrada"
 *      )
 *  )
 *
 * @OA\Delete(
 *      path="/api/todos/{id}",
 *      summary="Deleta uma tarefa específica pelo ID",
 *      description="Deleta uma tarefa pelo seu ID e retorna um status de sem conteúdo.",
 *      operationId="deleteTodo",
 *      tags={"Todos"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="ID da tarefa a ser deletada",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=204,
 *          description="No Content - A tarefa foi deletada com sucesso.",
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not Found - A tarefa com o ID fornecido não foi encontrada.",
 *      )
 *  )
 *
 * @OA\Put(
 *      path="/api/todos/{id}/complete",
 *      summary="Marca uma tarefa específica como completa",
 *      description="Atualiza o status de uma tarefa para 'completa' pelo seu ID e retorna a tarefa atualizada.",
 *      operationId="completeTodo",
 *      tags={"Todos"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="ID da tarefa a ser marcada como completa",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          description="Dados opcionais da tarefa para atualização",
 *          required=false,
 *          @OA\JsonContent(
 *              required={"title", "description"},
 *              @OA\Property(property="title", type="string", example="title teste editado"),
 *              @OA\Property(property="description", type="string", example="description teste editado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Operação bem-sucedida",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer", example=17),
 *              @OA\Property(property="title", type="string", example="title teste"),
 *              @OA\Property(property="description", type="string", example="description teste"),
 *              @OA\Property(property="completed", type="boolean", example=true)
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not Found - A tarefa com o ID fornecido não foi encontrada."
 *      )
 *  )
 *
 * @OA\Put(
 *      path="/api/todos/{id}/incomplete",
 *      summary="Marca uma tarefa específica como incompleta",
 *      description="Atualiza o status de uma tarefa para 'incompleta' pelo seu ID e retorna a tarefa atualizada.",
 *      operationId="incompleteTodo",
 *      tags={"Todos"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="ID da tarefa a ser marcada como incompleta",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          description="Dados opcionais da tarefa para atualização",
 *          required=false,
 *          @OA\JsonContent(
 *              required={"title", "description"},
 *              @OA\Property(property="title", type="string", example="title teste editado"),
 *              @OA\Property(property="description", type="string", example="description teste editado")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Operação bem-sucedida",
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="id", type="integer", example=17),
 *              @OA\Property(property="title", type="string", example="title teste"),
 *              @OA\Property(property="description", type="string", example="description teste"),
 *              @OA\Property(property="completed", type="boolean", example=false)
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Not Found - A tarefa com o ID fornecido não foi encontrada."
 *      )
 *  )
 *
 *
 */


class TodoRoute
{

}
