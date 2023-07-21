# Full-Stack Next.js + Laravel

## Next.js v13

- [React Essentials](https://nextjs.org/docs/getting-started/react-essentials)

  - [Server Components](https://nextjs.org/docs/getting-started/react-essentials#server-components)
  - [Client Components](https://nextjs.org/docs/getting-started/react-essentials#client-components)

- [Using App Router](https://nextjs.org/docs/app)

  - [Define Routes](https://nextjs.org/docs/app/building-your-application/routing/defining-routes)
  - [Pages and Layouts](https://nextjs.org/docs/app/building-your-application/routing/pages-and-layouts)
  - [Route Groups](https://nextjs.org/docs/app/building-your-application/routing/route-groups)
  - [Dynamic Routes](https://nextjs.org/docs/app/building-your-application/routing/dynamic-routes)
  - [Parallel Routes](https://nextjs.org/docs/app/building-your-application/routing/parallel-routes)

- [Data Fetching](https://nextjs.org/docs/app/building-your-application/data-fetching)

  - [`async` and `await` in Server Components](https://nextjs.org/docs/app/building-your-application/data-fetching/fetching#async-and-await-in-server-components)

    ```tsx
    async function getData() {
      const res = await fetch("https://api.example.com/...");
      // The return value is *not* serialized
      // You can return Date, Map, Set, etc.

      // Recommendation: handle errors
      if (!res.ok) {
        // This will activate the closest `error.js` Error Boundary
        throw new Error("Failed to fetch data");
      }

      return res.json();
    }

    export default async function Page() {
      const data = await getData();

      return <main></main>;
    }
    ```

    - Good to know:

      To use an `async` Server Component with TypeScript, ensure you are using TypeScript `5.1.3` or higher and `@types/react` `18.2.8` or higher.

  - [`use` in Client Components](https://nextjs.org/docs/app/building-your-application/data-fetching/fetching#use-in-client-components)

    - `use` is a new React function that **accepts a promise** conceptually similar to `await`. `use` **handles the promise** returned by a function in a way that is compatible with components, hooks, and Suspense. Learn more about use in the [React RFC](https://github.com/acdlite/rfcs/blob/first-class-promises/text/0000-first-class-support-for-promises.md#usepromise).

    - Wrapping `fetch` in `use` is currently **not** recommended in Client Components and may trigger multiple re-renders. For now, if you need to fetch data in a Client Component, we recommend using a third-party library such as [SWR](https://swr.vercel.app/) or [React Query](https://tanstack.com/query/v4).
