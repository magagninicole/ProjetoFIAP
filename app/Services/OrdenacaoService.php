<?php

namespace App\Services;

class OrdenacaoService
{
    /**
     * Ordena um array 
     *
     * @param array $dados  
     * @param string $coluna 
     * @param string $ordem 
     * @return array
     */
    public function ordenar(array $dados, string $coluna, string $ordem = 'asc'): array
    {
        usort($dados, function ($a, $b) use ($coluna, $ordem) {
            $valorA = $a[$coluna] ?? '';
            $valorB = $b[$coluna] ?? '';

            // compara ignorando acentos e maiúsculas
            $valorA = mb_strtolower($this->removerAcentos($valorA));
            $valorB = mb_strtolower($this->removerAcentos($valorB));

            if ($valorA == $valorB) return 0;

            return $ordem === 'asc'
                ? ($valorA < $valorB ? -1 : 1)
                : ($valorA > $valorB ? -1 : 1);
        });

        return $dados;
    }

    /**
     * Paginação de resultados.
     *
     * @param array $dados
     * @param int $pagina 
     * @param int $porPagina
     * @return array
     */
    public function paginar(array $dados, int $pagina = 1, int $porPagina = 10): array
    {
        $total = count($dados);
        $inicio = ($pagina - 1) * $porPagina;
        $paginados = array_slice($dados, $inicio, $porPagina);

        return [
            'dados' => $paginados,
            'pagina_atual' => $pagina,
            'total_paginas' => ceil($total / $porPagina),
            'total_registros' => $total
        ];
    }


     /**
     * Remove os acentos de uma string para facilitar a ordenação.
     * @param string $texto
     * @return string
     */
    private function removerAcentos($texto)
    {
        return preg_replace(
            [
                '/á|à|ã|â|ä/',
                '/é|è|ê|ë/',
                '/í|ì|î|ï/',
                '/ó|ò|õ|ô|ö/',
                '/ú|ù|û|ü/',
                '/ç/',
            ],
            ['a', 'e', 'i', 'o', 'u', 'c'],
            $texto
        );
    }
}
