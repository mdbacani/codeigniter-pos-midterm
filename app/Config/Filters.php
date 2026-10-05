<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterfaceHere is a comprehensive guide to implementing **Authentication**, **Controller Filters**, **Form Validation**, and the **Sales Workflow with Stock Validation** for your CodeIgniter Point-of-Sale project.

---

### 1. Authentication & Controller Filters
To satisfy the requirement that only logged-in staff members can reach any management page, you can use CodeIgniter Controller Filters.

* **Create the Filter (`app/Filters/AuthFilter.php`):**
```php
<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface {
    public function before(RequestInterface $request, $arguments = null) {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in to access management pages.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        // Nothing needed here
    }
}
