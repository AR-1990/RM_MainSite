<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Throwable;

class DevService
{
    public function clearApplicationCaches(): array
    {
        $optimizeClear = $this->runCommand('optimize:clear');
        $cacheClear = $this->runCommand('cache:clear');
        $configClear = $this->runCommand('config:clear');
        $routeClear = $this->runCommand('route:clear');
        $viewClear = $this->runCommand('view:clear');

        return [
            'success' => $this->isSuccessful($optimizeClear)
                && $this->isSuccessful($cacheClear)
                && $this->isSuccessful($configClear)
                && $this->isSuccessful($routeClear)
                && $this->isSuccessful($viewClear),
            'message' => 'Application caches clear process completed.',
            'results' => [
                'optimize_clear' => $optimizeClear,
                'cache_clear' => $cacheClear,
                'config_clear' => $configClear,
                'route_clear' => $routeClear,
                'view_clear' => $viewClear,
            ],
        ];
    }

    private function runCommand(string $command): array
    {
        try {
            Artisan::call($command);

            return [
                'command' => $command,
                'success' => true,
                'output' => trim(Artisan::output()) ?: 'Command executed successfully.',
            ];
        } catch (Throwable $exception) {
            return [
                'command' => $command,
                'success' => false,
                'output' => $exception->getMessage(),
            ];
        }
    }

    private function isSuccessful(array $result): bool
    {
        return isset($result['success']) && $result['success'] === true;
    }
}
