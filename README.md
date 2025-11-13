# Laravel 任務列表 (Lara10-task-list)

這是一個使用 Laravel 11 建構的簡易任務管理應用程式（To-Do List）。

使用者可以建立、讀取、更新和刪除 (CRUD) 任務，並將任務標記為已完成或未完成。

## 專案特色

-   **任務管理:**
    -   顯示所有任務列表 (分頁)
    -   查看單一任務詳情
    -   新增任務
    -   編輯現有任務
    -   刪除任務
    -   切換任務完成狀態
-   **表單驗證:** 使用 Laravel 的 Form Request (`TaskRequest`) 來驗證輸入資料。
-   **前端:**
    -   使用 Tailwind CSS (via CDN) 進行樣式設計。
    -   使用 Alpine.js (via CDN) 處理簡單的前端互動（例如快閃訊息的顯示）。

## 核心技術棧

-   **PHP:** ^8.2
-   **Laravel Framework:** ^11.9
-   **資料庫:** SQLite (預設)
-   **前端建置:** Vite

## 安裝與啟動

**需求:**

-   PHP >= 8.2
-   Composer
-   Node.js & npm (或 yarn / pnpm)

**步驟:**

1.  **Clone 儲存庫:**

    ```bash
    git clone [https://github.com/your-username/lara10-task-list.git](https://github.com/your-username/lara10-task-list.git)
    cd lara10-task-list
    ```

2.  **安裝後端依賴:**

    ```bash
    composer install
    ```

3.  **設定環境變數:**
    複製範例環境檔，在 Windows 上您可能需要使用 `copy`。

    ```bash
    cp .env.example .env
    ```

4.  **產生應用程式金鑰 (APP_KEY):**

    ```bash
    php artisan key:generate
    ```

5.  **設定資料庫:**
    此專案預設使用 SQLite。`composer.json` 中的腳本會自動建立 `database/database.sqlite` 檔案。

    -   **手動建立 (如果需要):**

        ```bash
        touch database/database.sqlite
        ```

    -   **執行資料庫遷移 (Migration):**
        這將會建立 `users`, `tasks`, `cache` 等所有必要的資料表。
        ```bash
        php artisan migrate
        ```

6.  **(可選) 填充測試資料:**
    這將使用 Factory 建立 10 位使用者和 20 個任務。

    ```bash
    php artisan db:seed
    ```

7.  **安裝前端依賴:**

    ```bash
    npm install
    ```

8.  **啟動開發伺服器:**

    -   **啟動 Vite (處理前端資源):**
        ```bash
        npm run dev
        ```
    -   **(另開一個終端機) 啟動 Laravel 伺服器:**
        ```bash
        php artisan serve
        ```

9.  **訪問應用程式:**
    開啟瀏覽器並訪問 `http://127.0.0.1:8000`
